<?php

namespace Media;

class upload{
    public $error = array(
			1 => 'Filens størrelse overskrider \'upload_max_filesize\' directivet i php.ini.',
			2 => 'Filen størrelse overskride \'MAX_FILE_SIZE\' directivet i HTML formen.',
			3 => 'File blev kun delvis uploadet.',
			4 => 'Filen blev ikke uploaded.',
			6 => 'Kunne ikke finde \'tmp\' mappen.',
			7 => 'Kunne ikke gemme filen på disken.',
			8 => 'A PHP extension stopped the file upload.'
		); 

    public function uploadImage($inputFieldName, $mimeType = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp'], $folder = '../media/'){
        if($_FILES[$inputFieldName]['error'] === 0){
            $file = $_FILES[$inputFieldName];
            if(!in_array($file['type'], $mimeType)){
                return [
                    'error' => false,
                    'msg' => 'Filtypen er ikke tilladt.'
                ];
            }

            if(!file_exists($folder)){
                mkdir($folder, 0755, true);
            }

            $fileName = time() . '_' . $file['name'];
            $fileName = str_replace(' ', '', $fileName);
            if(move_uploaded_file($file['tmp_name'], $folder . $fileName)){
                return [
                    'error' => false,
                    'name' => $fileName,
                    'type' => $file['type']
                ];
            }
        }

        return [
            'error' => true,
            'msg' => $this->error[$_FILES[$inputFieldName]['error']]
        ];
    }
}