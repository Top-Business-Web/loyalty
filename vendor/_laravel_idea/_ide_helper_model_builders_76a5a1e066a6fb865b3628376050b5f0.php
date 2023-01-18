<?php //ff9c1aaf5b073d530f513ef1fe71cc33
/** @noinspection all */

namespace LaravelIdea\Helper\App\Models {

    use App\Models\Admin;
    use App\Models\Slider;
    use App\Models\User;
    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;

    /**
     * @method Admin|null getOrPut($key, $value)
     * @method Admin|$this shift(int $count = 1)
     * @method Admin|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Admin|$this pop(int $count = 1)
     * @method Admin|null pull($key, $default = null)
     * @method Admin|null last(callable $callback = null, $default = null)
     * @method Admin|$this random(int|null $number = null)
     * @method Admin|null sole($key = null, $operator = null, $value = null)
     * @method Admin|null get($key, $default = null)
     * @method Admin|null first(callable $callback = null, $default = null)
     * @method Admin|null firstWhere(string $key, $operator = null, $value = null)
     * @method Admin|null find($key, $default = null)
     * @method Admin[] all()
     */
    class _IH_Admin_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Admin[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Admin_QB whereId($value)
     * @method _IH_Admin_QB whereName($value)
     * @method _IH_Admin_QB whereEmail($value)
     * @method _IH_Admin_QB wherePassword($value)
     * @method _IH_Admin_QB whereImage($value)
     * @method _IH_Admin_QB whereCreatedAt($value)
     * @method _IH_Admin_QB whereUpdatedAt($value)
     * @method Admin baseSole(array|string $columns = ['*'])
     * @method Admin create(array $attributes = [])
     * @method _IH_Admin_C|Admin[] cursor()
     * @method Admin|null|_IH_Admin_C|Admin[] find($id, array $columns = ['*'])
     * @method _IH_Admin_C|Admin[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Admin|_IH_Admin_C|Admin[] findOrFail($id, array $columns = ['*'])
     * @method Admin|_IH_Admin_C|Admin[] findOrNew($id, array $columns = ['*'])
     * @method Admin first(array|string $columns = ['*'])
     * @method Admin firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Admin firstOrCreate(array $attributes = [], array $values = [])
     * @method Admin firstOrFail(array $columns = ['*'])
     * @method Admin firstOrNew(array $attributes = [], array $values = [])
     * @method Admin firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Admin forceCreate(array $attributes)
     * @method _IH_Admin_C|Admin[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Admin_C|Admin[] get(array|string $columns = ['*'])
     * @method Admin getModel()
     * @method Admin[] getModels(array|string $columns = ['*'])
     * @method _IH_Admin_C|Admin[] hydrate(array $items)
     * @method Admin make(array $attributes = [])
     * @method Admin newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Admin[]|_IH_Admin_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Admin[]|_IH_Admin_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Admin sole(array|string $columns = ['*'])
     * @method Admin updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Admin_QB extends _BaseBuilder {}

    /**
     * @method Slider|null getOrPut($key, $value)
     * @method Slider|$this shift(int $count = 1)
     * @method Slider|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Slider|$this pop(int $count = 1)
     * @method Slider|null pull($key, $default = null)
     * @method Slider|null last(callable $callback = null, $default = null)
     * @method Slider|$this random(int|null $number = null)
     * @method Slider|null sole($key = null, $operator = null, $value = null)
     * @method Slider|null get($key, $default = null)
     * @method Slider|null first(callable $callback = null, $default = null)
     * @method Slider|null firstWhere(string $key, $operator = null, $value = null)
     * @method Slider|null find($key, $default = null)
     * @method Slider[] all()
     */
    class _IH_Slider_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Slider[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method Slider baseSole(array|string $columns = ['*'])
     * @method Slider create(array $attributes = [])
     * @method _IH_Slider_C|Slider[] cursor()
     * @method Slider|null|_IH_Slider_C|Slider[] find($id, array $columns = ['*'])
     * @method _IH_Slider_C|Slider[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Slider|_IH_Slider_C|Slider[] findOrFail($id, array $columns = ['*'])
     * @method Slider|_IH_Slider_C|Slider[] findOrNew($id, array $columns = ['*'])
     * @method Slider first(array|string $columns = ['*'])
     * @method Slider firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Slider firstOrCreate(array $attributes = [], array $values = [])
     * @method Slider firstOrFail(array $columns = ['*'])
     * @method Slider firstOrNew(array $attributes = [], array $values = [])
     * @method Slider firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Slider forceCreate(array $attributes)
     * @method _IH_Slider_C|Slider[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Slider_C|Slider[] get(array|string $columns = ['*'])
     * @method Slider getModel()
     * @method Slider[] getModels(array|string $columns = ['*'])
     * @method _IH_Slider_C|Slider[] hydrate(array $items)
     * @method Slider make(array $attributes = [])
     * @method Slider newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Slider[]|_IH_Slider_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Slider[]|_IH_Slider_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Slider sole(array|string $columns = ['*'])
     * @method Slider updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Slider_QB extends _BaseBuilder {}

    /**
     * @method User|null getOrPut($key, $value)
     * @method User|$this shift(int $count = 1)
     * @method User|null firstOrFail($key = null, $operator = null, $value = null)
     * @method User|$this pop(int $count = 1)
     * @method User|null pull($key, $default = null)
     * @method User|null last(callable $callback = null, $default = null)
     * @method User|$this random(int|null $number = null)
     * @method User|null sole($key = null, $operator = null, $value = null)
     * @method User|null get($key, $default = null)
     * @method User|null first(callable $callback = null, $default = null)
     * @method User|null firstWhere(string $key, $operator = null, $value = null)
     * @method User|null find($key, $default = null)
     * @method User[] all()
     */
    class _IH_User_C extends _BaseCollection {
        /**
         * @param int $size
         * @return User[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_User_QB whereId($value)
     * @method _IH_User_QB whereUserName($value)
     * @method _IH_User_QB whereEmail($value)
     * @method _IH_User_QB wherePassword($value)
     * @method _IH_User_QB whereImage($value)
     * @method _IH_User_QB whereRememberToken($value)
     * @method _IH_User_QB whereCreatedAt($value)
     * @method _IH_User_QB whereUpdatedAt($value)
     * @method User baseSole(array|string $columns = ['*'])
     * @method User create(array $attributes = [])
     * @method _IH_User_C|User[] cursor()
     * @method User|null|_IH_User_C|User[] find($id, array $columns = ['*'])
     * @method _IH_User_C|User[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method User|_IH_User_C|User[] findOrFail($id, array $columns = ['*'])
     * @method User|_IH_User_C|User[] findOrNew($id, array $columns = ['*'])
     * @method User first(array|string $columns = ['*'])
     * @method User firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method User firstOrCreate(array $attributes = [], array $values = [])
     * @method User firstOrFail(array $columns = ['*'])
     * @method User firstOrNew(array $attributes = [], array $values = [])
     * @method User firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method User forceCreate(array $attributes)
     * @method _IH_User_C|User[] fromQuery(string $query, array $bindings = [])
     * @method _IH_User_C|User[] get(array|string $columns = ['*'])
     * @method User getModel()
     * @method User[] getModels(array|string $columns = ['*'])
     * @method _IH_User_C|User[] hydrate(array $items)
     * @method User make(array $attributes = [])
     * @method User newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|User[]|_IH_User_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|User[]|_IH_User_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method User sole(array|string $columns = ['*'])
     * @method User updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_User_QB extends _BaseBuilder {}
}
