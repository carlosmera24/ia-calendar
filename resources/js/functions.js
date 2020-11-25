/**
 * Funciones personalizadas, con métodos de ayuda o generales
 * Por Carlos Eduardo Mera Ruiz
 */

 /**
 * Función encargada de procesar los errores retornados por el request en
 * una peticón ajax
 * @param response error.response
 * @return JSON {text,errors[]}
 */
export function procesarErroresRequest(response) {
    var text = '';
    var errors = [];
    switch (response.status) {
        case 0:
            // text = 'Error en su conexión a internet';
            text += response.statusText;
            break;
        case 400:
            text += response.statusText;
            Object.keys(response.data.data).forEach(function (key) {
                response.data.data[key].forEach(function (content) {
                    errors[errors.length] = content;
                });
            });
            break;
        // case 419:
        //     text = 'Excepción: Coincidencia de token CSRF';
        //     break;
        // case 404:
        //     text = 'Solicitud no encontrada';
        //     break;
        // case 405:
        //     text = 'Método no permitido';
        //     break;
        // case 500:
        //     text = 'Error en su solicitud, por favor intentelo más tarde.';
        //     break;
        // case 503:
        //     text = 'Problemas con su conexión a Internet, por favor intentelo más tarde.';
        //     break;
        default:
            text += response.statusText;
            // if (response.statusText == "abort") {
            //     text = 'Su solicitud ha sido abortada, por favor inténtelo más tarde.';
            // } else {
            //     text = 'Lo sentimos, error desconocido' + response.statusText + '';
            // }
            break;
    }

    return {
        text: text,
        errors: errors
    };
}
