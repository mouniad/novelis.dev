<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupContact extends Model
{
    protected $guarded = [];
    /**
     * contact - GroupContact relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'group_contact_id');
    }
}
