<?php 
namespace Plugins\SummerNote;

use Illuminate\Routing\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Response;

class SummerNoteController extends Controller
{
    /**
    * Return stylesheets.
    *
    * @return Illuminate\Http\Response
    */
    public function getStyles()
    {
        $content = $this->dumpAssetsAsString('css');

        $response = response(
            $content, 200, [
                'Content-Type' => 'text/css',
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
    * Return javascript resources.
    *
    * @return Illuminate\Http\Response
    */
    public function getJS()
    {
        $content = $this->dumpAssetsAsString('js');

        $response = response(
            $content, 200, [
                'Content-Type' => 'text/javascript',
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
    * Return font resources.
    *
    * @return Illuminate\Http\Response
    */
    public function getFonts($font)
    {
        $fs = new Filesystem;

        $fontPath= __DIR__ . '/Assets/font/' . $font;

        $mime = $fs->mimeType($fontPath);
        $content = $fs->get($fontPath);
        
        $response = response(
            $content, 200, [
                'Content-Type' => $mime,
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
     * Return assets as a string
     *
     * @param type
     * @return string
     */
    public function dumpAssetsAsString($type)
    {
        $fs = new Filesystem;
        $files = $fs->allFiles(__DIR__ . '/Assets');

        $content = '';
        foreach ($files as $file) {
            if ($fs->extension($file) <> $type) {
                continue;
            }

            $content .= file_get_contents($file) . "\n";
        }

        return $content;
    }

    /**
     * Cache the response 1 year (31536000 sec)
     */
    protected function cacheResponse(Response $response)
    {
        $response->setSharedMaxAge(31536000);
        $response->setMaxAge(31536000);
        $response->setExpires(new \DateTime('+1 year'));

        return $response;
    }
}
