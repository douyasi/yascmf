<?php

namespace Douyasi\Repositories;

use Douyasi\Models\Setting;
use Douyasi\Models\SettingType;

/**
 * 动态设置仓库SettingRepository
 * 本仓库操作2个模型：Setting与SettingType
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class SettingRepository extends BaseRepository
{

    /**
     * The Setting instance.
     *
     * @var Douyasi\Models\setting
     */
    protected $setting;

    /**
     * Create a new SettingRepository instance.
     *
     * @param  Douyasi\Models\SettinType $setting_type
     * @param  Douyasi\Models\Setting $setting
     * @return void
     */
    public function __construct(
        SettingType $setting_type,
        Setting $setting)
    {
        $this->model = $setting_type;  //注意这里$this->model指向SettingType
        $this->setting = $setting;  //而$this->setting指向Setting
    }




    /**
     * 取得所有动态设置类型数据
     *
     * @return  Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * 创建或更新动态设置
     *
     * @param  Douyasi\Models\Setting
     * @param  array $inputs
     * @return Douyasi\Models\Setting
     */
    private function saveSetting($setting, $inputs)
    {
        $setting->name = e($inputs['name']);
        $setting->value = e($inputs['value']);
        $setting->type_id = e($inputs['type_id']);
        if (array_key_exists('status', $inputs)) {
            $setting->status = e($inputs['status']);
        }
        if (array_key_exists('sort', $inputs)) {
            $setting->sort = e($inputs['sort']);
        }
        $setting->save();
        return $setting;
    }

    /**
     * 创建或更新动态设置分组
     *
     * @param  Douyasi\Models\SettingType
     * @param  array $inputs
     * @return Douyasi\Models\SettingType
     */
    private function saveType($setting_type, $inputs)
    {
        $setting_type->name = e($inputs['name']);
        $setting_type->value = e($inputs['value']);
        if (array_key_exists('sort', $inputs)) {
            $setting_type->sort = e($inputs['sort']);
        }
        $setting_type->save();
        return $setting_type;
    }

    /**
     * 侦测当前当前分组下是否有动态设置
     *
     * @param  int $type_id
     * @return boolean 如果当前当前分组下有动态设置，则返回true，否则返回false
     */
    public function hasSetting($type_id)
    {
        $setting = $this->setting->where('type_id', '=', $type_id)->get();
        if ($setting->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 动态设置资源列表数据
     *
     * @param  array $data 额外传入的参数
     * @param  string $for 操作对象，默认对Setting操作，否则对SettingType操作
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $for = 'setting', $size = '10')
    {
        if (!ctype_digit($size)) {
            $size = '10';
        }
        $data = array_add($data, 's_title', '');
        $data = array_add($data, 's_value', '');
        if ($for === 'setting') {
            $settings = $this->setting->join('setting_type', 'settings.type_id', '=', 'setting_type.id')
                                     ->select('settings.*', 'setting_type.name as tname', 'setting_type.id as tid', 'setting_type.name as tname', 'setting_type.value as tvalue')
                                     ->where('settings.name', 'like', '%'.e($data['s_name']).'%')
                                     ->where('settings.value', 'like', '%'.e($data['s_value']).'%')
                                     ->orderBy('sort', 'desc')
                                     ->orderBy('id', 'desc')
                                     ->paginate($size);
            return $settings;
        } else {
            $setting_types = $this->model->where('name', 'like', '%'.e($data['s_name']).'%')
                                        ->where('value', 'like', '%'.e($data['s_value']).'%')
                                        ->orderBy('sort', 'desc')
                                        ->orderBy('id', 'asc')
                                        ->paginate($size);
            return $setting_types;
        }
    }

    /**
     * 存储Setting
     *
     * @param  array  $inputs
     * @param  string $for 操作对象，默认对Setting操作，否则对SettingType操作
     * @return Douyasi\Models\Setting | Douyasi\Models\SettingType
     */
    public function store($inputs, $for = 'setting')
    {
        if ($for === 'setting') {
            $setting = new $this->setting;
            $setting = $this->saveSetting($setting, $inputs);
            return $setting;
        } else {  //操作SettingType模型
            $setting_type = new $this->model;
            $setting_type = $this->saveType($setting_type, $inputs);
            return $setting_type;
        }
    }

    /**
     * 展示特定动态设置分组下动态设置[这里涉及到分页]
     *
     * @param  int $id
     * @param  string $size
     * @return Illuminate\Support\Collection
     */
    public function show($id, $size = '10')
    {
        if (!ctype_digit($size)) {
            $size = '10';
        }
        $settings = $this->setting->join('setting_type', 'settings.type_id', '=', 'setting_type.id')
                                 ->where('type_id', '=', $id)
                                 ->select('settings.*', 'setting_type.name as tname', 'setting_type.id as tid', 'setting_type.name as tname', 'setting_type.value as tvalue')
                                 ->orderBy('sort', 'desc')
                                 ->orderBy('id', 'desc')
                                 ->paginate($size);
        return $settings;
    }

    /**
     * 获取编辑的动态设置或其分组
     *
     * @param  int $id
     * @param  string $for 操作对象，默认对Setting操作，否则对SettingType操作
     * @return Illuminate\Support\Collection
     */
    public function edit($id, $for = 'setting')
    {
        if ($for === 'setting') {
            $setting = $this->setting->findOrFail($id);
            return $setting;
        } else {
            $setting_type = $this->getById($id);
            return $setting_type;
        }
    }

    /**
     * 更新内容
     *
     * @param  array  $inputs
     * @param  int    $id
     * @param  string $for 操作对象，默认对Setting操作，否则对SettingType操作
     * @return void
     */
    public function update($id, $inputs, $for = 'setting')
    {
        if ($for === 'setting') {
            $setting = $this->setting->findOrFail($id);
            $setting = $this->saveSetting($setting, $inputs);
            return $setting;
        } else {
            $setting_type = $this->getById($id);
            $setting_type = $this->saveType($setting_type, $inputs);
            return $setting_type;
        }
    }

    /**
     * 删除动态设置或其分组
     *
     * @param  int $id
     * @param  string $for 操作对象，默认对Setting操作，否则对SettingType操作
     * @return void
     */
    public function destroy($id, $for = 'setting')
    {
        if ($for === 'setting') {
            $setting = $this->setting->findOrFail($id);
            $setting->delete();
        } else {
            $setting_type = $this->getById($id);
            $setting_type->delete();
        }
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********

}
