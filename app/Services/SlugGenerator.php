<?php

namespace App\Services;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;

/**
 * Class SlugGenerator
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Services
 *
 */
class SlugGenerator
{
    /**
     * @var DatabaseManager|Connection
     */
    private $db;

    /**
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param string    $table
     * @param string    $name
     * @param int|array $exclude
     *
     * @return string
     */
    public function generate($table, $name, $exclude = null)
    {
        $suffix = '';
        $slug   = str_slug($name);

        do {
            $slug .= ($suffix ? '-' : '') . $suffix;

            $suffix = mt_rand(0, 9);
        } while ($this->checkSlugExists($table, $slug, $exclude));

        return $slug;
    }

    /**
     * @param string    $table
     * @param string    $slug
     * @param int|array $exclude
     *
     * @return mixed
     */
    private function checkSlugExists($table, $slug, $exclude = null)
    {
        $builder = $this->db->table($table)->where('slug', '=', $slug);

        if (is_int($exclude))
            $builder->where('id', '<>', $exclude);

        if (is_array($exclude))
            foreach ($exclude as $id) {
                $builder->where('id', '<>', $id);
            }

        $test = $builder->first('id');

        return boolval($test);
    }
}
