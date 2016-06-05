<?php
namespace Meccado\ArticleAdmin\Facade;
use Illuminate\Support\Facades\Facade;

class ArticleAdminFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'article_admin';
    }
}
