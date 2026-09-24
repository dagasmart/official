<?php

namespace DagaSmart\Official\Services;

use DagaSmart\Official\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

/**
 * 基础-联系类
 *
 */
/**
 * 门禁设备-服务类
 *
 * @method Contact getModel()
 * @method Contact|Builder query()
 */
class ContactService extends AdminService
{
    protected string $modelName = Contact::class;


}
