<?php

namespace App\Rules;

use App\Page;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExistingKeys implements Rule
{
    /**
     * @var string
     */
    private $tableName;

    /**
     * @var Page
     */
    private $page;

    /**
     * Create a new rule instance.
     *
     * @param string $tableName
     * @param Page   $page
     */
    public function __construct(string $tableName, Page $page)
    {
        $this->tableName = $tableName;
        $this->page = $page;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $keys = array_keys($value);
        return DB::table($this->tableName)->where('page_id', $this->page->id)->whereIn('key', $keys)->count() == count($keys);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Invalid key(s) used.";
    }
}
