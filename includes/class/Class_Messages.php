<?php
/**
 * Class that handles messaging to user.
 * @version 1
 * @author pedro
 */

class Messages {

    public function  __construct() {

    }

    public static function getMessage($code) {
        switch((int) $code) {
            case 0 : {
                    return htmlentities("Operação concluída com sucesso.");
                }
            case 1048 : {
                    return htmlentities("Um campo obrigatório está vazio.");
                }
            case 1451 : {
                    return htmlentities("Outros registos precisam desta informação, por favor, apague primeiro esses registos.");
                }
            case 1062 : {
                    return htmlentities("Este registo já se encontra na base de dados.");
                }
            case -1: {
                return htmlentities("Erro ao efectuar upload do ficheiro. Verifique se o ficheiro não existe e se tem permissões de escrita no directório.");
            }
            case -2 : {
                return htmlentities("Ocorreu um erro ao eliminar o ficheiro.");
            }
            case -3 : {
                return htmlentities("O ficheiro não tem a altura igual ou a largura.");
            }
            default : {
                    return $code;
                }
        }
    }
}
?>
