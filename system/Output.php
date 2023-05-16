<?php

namespace system;

class Output
{
    /**
     * @param $path
     * @param $variable
     * @return void
     */
    public function view($path, $variable = []): void
    {
        $file = './view/' . $path . '.php';

        if (file_exists($file)) {
            extract($variable);

            ob_start();

            require($file);

            $output = ob_get_contents();

            ob_end_clean();

            echo $output;
        } else {
            trigger_error('Not found' . $file . '!');
            exit();
        }
    }
}

