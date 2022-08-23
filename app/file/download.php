<?php 
    $code = $_POST['code'];
    $rootPath = '../../public/'.$code;
    
    $zip = new ZipArchive();
    if(!is_dir('../../public/download')) {
        mkdir('../../public/download');
    }

    
    $archive_name = '../../public/download/'.$code.'_ALLFILES.zip'; // name of zip file
    $archive_folder = $rootPath; // the folder which you archivate

    $zip = new ZipArchive;
    if ($zip -> open($archive_name, ZipArchive::CREATE) === TRUE)
    {
        $dir = $rootPath.'/';
    
        $dirs = array($dir);
        while (count($dirs))
        {
            $dir = current($dirs);
            $zip -> addEmptyDir($dir);
        
            $dh = opendir($dir);
            while($file = readdir($dh))
            {
                if ($file != '.' && $file != '..')
                {
                    if (is_file($file))
                        $zip -> addFile($dir.$file, $dir.$file);
                    elseif (is_dir($file))
                        $dirs[] = $dir.$file."/";
                }
            }
            closedir($dh);
            array_shift($dirs);
        }
    }

    // show directories having files
    // if($zip->open('../../public/download/'.$code.'_ALLFILES.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
    //     listFolderFiles($rootPath, $rootPath, $zip);
    // } else {
    //     echo "failed";
    // }

    // function listFolderFiles($dir, $rootPath, $zipArchive)
    // {
    //     foreach (new DirectoryIterator($dir) as $fileInfo) {
    //         if (!$fileInfo->isDot()) {
    //             if ($fileInfo->isDir()) {    
    //                 listFolderFiles($fileInfo->getPathname(), $rootPath, $zipArchive);
    //             } else {
    //                 $filePath = $fileInfo->getPathname();
    //                 $relativePath = substr($filePath, strlen($rootPath) + 1);

    //                 // Add current file to archive
    //                 $zipArchive->addFile($filePath, $relativePath);
    //             }
    //         }
    //     }
    // }

    $zip->close();

    echo $code;

?>