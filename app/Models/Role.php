<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = [
        'permissions_name'
    ];
    public function getPermissionsNameAttribute(){
        $perArr = json_decode($this->attributes['permissions'],true);

        $perName = [];
        if($perArr){
            foreach ($perArr as $key => $val) {
                $permission = Permission::find($val);
                $perName[] = $permission?$permission->name:"";
            }
            return implode(", ",$perName);
        }
        return [];

    }

}
