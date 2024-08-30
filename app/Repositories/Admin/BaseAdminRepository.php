<?php

namespace App\Repositories\Admin;

use App\Enums\EPrimaryCategory;
use App\Enums\EPrimaryRegion;
use App\Enums\EPrimaryService;
use App\Enums\EPrimarySubservice;
use App\Enums\EPrimaryTag;
use App\Enums\EState;
use App\Models\Category\Category;
use App\Models\Member\Member;
use App\Models\Metadata\Metadata;
use App\Models\Provider\Provider;
use App\Models\Region\Region;
use App\Models\Service\Service;
use App\Models\Subservice\Subservice;
use App\Models\Tag\Tag;
use App\Models\User\User;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class BaseAdminRepository extends Repository
{
    public function get($columns = ['*'])
    {
        return $this->query()->get($columns);
    }

    public function findOrFail($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->query()
            ->where($field, $value)
            ->first($columns);
    }

    public function create($data)
    {
        return $this->query()->create($data);
    }

    public function update($item, $data)
    {
        return $item->update($data);
    }

    public function forceCreate($data)
    {
        $item = $this->getModel()->newInstance();

        $item->forceFill($data);

        $item->save();

        return $item;
    }

    public function forceUpdate($item, $data)
    {
        $item->forceFill($data);

        $item->save();

        return $item;
    }

    public function updateState($id)
    {
        $item = $this->query()
            ->withTrashed()
            ->select(['id', 'state'])
            ->find($id);

        return $item->update([
            'state' => $item->state == EState::ENABLED ? EState::DISABLED : EState::ENABLED,
        ]);
    }

    public function destroy($id)
    {
        return $this->query()
            ->where('id', $id)
            ->forceDelete();
    }

    public function softDelete($id)
    {
        return $this->query()
            ->where('id', $id)
            ->delete();
    }

    public function restore($id)
    {
        return $this->query()
            ->where('id', $id)
            ->restore();
    }

    public function bulkUpdateState($request)
    {
        $data = $request->all();
        return $this->query()
            ->withTrashed()
            ->whereIn('id', $data['ids'])
            ->update([
                'state' => ($data['state'] === 'enabled' ? EState::ENABLED : EState::DISABLED),
            ]);
    }

    public function bulkDestroy($request)
    {
        $data = $request->all();
        return $this->query()
            ->whereIn('id', $data['ids'])
            ->forceDelete();
    }

    public function bulkSoftDelete($request)
    {
        $data = $request->all();
        return $this->query()
            ->whereIn('id', $data['ids'])
            ->delete();
    }

    public function bulkRestore($request)
    {
        $data = $request->all();
        return $this->query()
            ->whereIn('id', $data['ids'])
            ->restore();
    }

    public function multipleItems($request)
    {
        $q = $request->input('q');
        $type = $request->input('type');

        if (empty($q)) {
            return json_encode([]);
        }

        switch ($type) {
            case Tag::class;
                return $this->getTagItems($q);
            case Category::class;
                return $this->getCategoryItems($q);
            case Region::class;
                return $this->getRegionItems($q);
            case Service::class;
                return $this->getServiceItems($q);
            case Subservice::class;
                return $this->getSubserviceItems($q);
            case Member::class;
                return $this->getMemberItems($q);
            case Provider::class;
                return $this->getProviderItems($q);
            case User::class;
                return $this->getUserItems($q);
        }
    }

    public function getTagItems($q)
    {
        $items = Tag::query()
            ->enabled()
            ->where('title', 'like', '%' . $q . '%')
            ->pluck('title', 'id')
            ->map(function ($item, $key) {
                return [
                    'id' => $key,
                    'title' => $item,
                ];
            });

        return json_encode($items);
    }

    public function getCategoryItems($q)
    {
        $items = Category::query()
            ->enabled()
            ->where('title', 'like', '%' . $q . '%')
            ->pluck('title', 'id')
            ->map(function ($item, $key) {
                return [
                    'id' => $key,
                    'title' => $item,
                ];
            });

        return json_encode($items);
    }

    public function getRegionItems($q)
    {
        $items = Region::query()
            ->enabled()
            ->where('title', 'like', '%' . $q . '%')
            ->pluck('title', 'id')
            ->map(function ($item, $key) {
                return [
                    'id' => $key,
                    'title' => $item,
                ];
            });

        return json_encode($items);
    }

    public function getServiceItems($q)
    {
        $items = Service::query()
            ->enabled()
            ->where('title', 'like', '%' . $q . '%')
            ->pluck('title', 'id')
            ->map(function ($item, $key) {
                return [
                    'id' => $key,
                    'title' => $item,
                ];
            });

        return json_encode($items);
    }

    public function getSubserviceItems($q)
    {
        $items = Subservice::query()
            ->enabled()
            ->where('title', 'like', '%' . $q . '%')
            ->pluck('title', 'id')
            ->map(function ($item, $key) {
                return [
                    'id' => $key,
                    'title' => $item,
                ];
            });

        return json_encode($items);
    }

    public function getMemberItems($q)
    {
        $items = Member::query()
            ->where('name', 'like', '%' . $q . '%')
            ->orWhere('surname', 'like', '%' . $q . '%')
            ->select([
                'id',
                'name',
                'surname',
            ])
            ->get()
            ->map(function ($item, $key) {
                return [
                    'id' => $item->user->id,
                    'title' => $item->fullname,
                ];
            });

        return json_encode($items);
    }

    public function getProviderItems($q)
    {
        $items = Provider::query()
            ->where('name', 'like', '%' . $q . '%')
            ->orWhere('surname', 'like', '%' . $q . '%')
            ->orWhere('company_name', 'like', '%' . $q . '%')
            ->select([
                'id',
                'name',
                'surname',
                'company_name',
            ])
            ->get()
            ->map(function ($item, $key) {
                return [
                    'id' => $item->user->id,
                    'title' => $item->fullname,
                ];
            });

        return json_encode($items);
    }

    public function getUserItems($q)
    {
        $items = User::query()
            ->where('mobile', 'like', '%' . $q . '%')
            ->orWhere('email', 'like', '%' . $q . '%')
            ->orWhere('id', 'like', '%' . $q . '%')
            ->orWhereHas('userable', function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('surname', 'like', '%' . $q . '%');
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->fullname,
                ];
            });

        return json_encode($items);
    }

    public function __call($method, $args)
    {
        return call_user_func_array(
            [$this->getModel(), $method],
            $args
        );
    }
}
