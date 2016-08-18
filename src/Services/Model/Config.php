<?php

namespace Jani\DbConfig\Services\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    const TABLE_NAME = 'config';

    const FIELD_ID                  = 'id';
    const FIELD_NAMESPACE           = 'namespace';
    const FIELD_KEY                 = 'key';
    const FIELD_VALUE               = 'value';
    const FIELD_DEFAULT             = 'default';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config';

}