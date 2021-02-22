<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messeges Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default  messages for notification/info
    |
    */
    'success'                   =>  'Éxito!',
    'created_participant'       =>  'Partícipe creado satisfactoriamente.',
    'updated_participant'       =>  'Partícipe actualizado satisfactoriamente.',
    'no_options'                =>  'No hay opciones disponibles.',
    'loading'                   =>  'Cargando...',
    'updated_programmer'        =>  'Programador actualizado satisfactoriamente.',
    'updated_participant'       =>  'Partícipe actualizado satisfactoriamente.',
    'size_limit_logo_upload'    =>  'El archivo no puede ser mayor a 5MB',
    'updated_password'          =>  'Contraseña actualizada',

    //Emails
    'emails' => [
                    'confirmation'  =>  [
                                            'subject'               =>  'Confirmación de E-Mail',
                                            'greeting'              =>  'Hola :name,',
                                            'description'           =>  'Necesitamos confirmar tu correo electrónico <b>:email</b>',
                                            'click_confirm'         =>  'Click para confirmar',
                                            'copy_link'             =>  'o copia el siguiente enlace en la barra de direcciones de tu navegador',
                                            'footer'                =>  "Mensaje de prueba enviado desde el servidor de IA-Calendar's",
                                            'not_found'             =>  "Lo sentimos el email que intenta confirmar no se encontró en nustra base de datos.",
                                            'previous_confirmed'    =>  "El email <i>:email</i> ya ha sido confirmado previamente.",
                                            'success'               =>  "Gracias por confirmar tu email <i>:email</i>.",
                                            'success_subtitle'      =>  "Confirmación realizada con éxito!!!.",
                                        ],
                ],

    //Errors
    'bad_request'               =>  'Solicitud incorrecta',
    'error_saving'              =>  'Error al guardar :attribute en la base de datos',
    'error_updating'            =>  'Error al actualizar :attribute en la base de datos',
    'no_content'                =>  'Sin contenido',
    'no_found'                  =>  'No se encontró :attribute con ID :id',
    'empty_categories_required' =>  'Actualmente no tiene categorías creadas, por favor cree una para continuar.',
    'forbidden'                 =>  'Prohibido.',

    //Warnings
    'back_to_participant_confirm'   =>  '¿Desea restaurar el partícipe?, Se eliminarán todos los permisos, categorías y credenciales asociadas',
    'back_to_participant_warning'   =>  'Al presionar el botón <strong>Aplicar</strong> se eliminarán todos los permisos, categorías y credenciales asociadas',
    'updated_password_warning'      =>  'Contraseña actualizada exitosamente. Por seguridad se han cerrado todas las sesiones asociadas al usuario en los diferentes dispositivos, deberá iniciar sesión nuevamente.',
];
