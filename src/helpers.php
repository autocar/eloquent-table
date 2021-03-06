<?php

/**
 * Returns a URL with supplied query parameters and current icon for
 * the current sort direction
 *
 * @param string $title
 * @param array $parameters
 * @return string
 */
if (!function_exists('sortableUrlLink')) {
    function sortableUrlLink($title, $parameters)
    {
        $field = Input::get('field');
        $sort = strtolower(Input::get('sort'));

        /*
         * Make sure we flip sorting if the sort field is already descending
         */
        if ($sort === 'desc') {
            $parameters['sort'] = 'asc';
        } else {
            $parameters['sort'] = 'desc';
        }

        /*
         * Make sure the current html link is for the currently sorted field
         */
        if ($field === $parameters['field']) {

            /*
             * Sort parameter will actually be the opposite of what is being displayed
             */
            switch($parameters['sort']) {

                case 'asc':
                    $icon = Config::get('eloquenttable::default_sorting_icons.desc_sort_class');
                    break;

                case 'desc';
                    $icon = Config::get('eloquenttable::default_sorting_icons.asc_sort_class');
                    break;

                default:
                    break;

            }

        } else {

            /*
             * Display the base sorting class icon
             */
            $icon = sprintf('%s', Config::get('eloquenttable::default_sorting_icons.sort_class'));

        }

        /*
         * Now we'll return a link of the current page with the sorting parameters attached
         */
        return sprintf('<a class="link-sort" href="%s">%s <i class="%s"></i></a>', Request::url() . '?' . http_build_query($parameters), $title, $icon);
    }
}

/**
 * Helper for view facade. Checks if view helper function already exists
 * for Laravel 5 support. This is identical to the Laravel 5 view() helper.
 *
 * @param string $view
 * @param array $data
 * @param array $mergeData
 * @return mixed
 */
if (!function_exists('view')) {
    function view($view, $data = array(), $mergeData = array())
    {
        return View::make($view, $data, $mergeData);
    }
}