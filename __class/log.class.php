<?php

/**
 * Document    : __class/log.php
 * Created on  : 20110414
 * Last update : 20130906
 *
 * @author     : Stéphane KOEBERLE
 * @copyright  : Link To Business
 * @version    : 3.0
 */
class log
{

    private $id;
    private $session;
    private $action;
    private $value;
    private $detail;
    private $datetime;
    private $content;

    /**
     * Construction de l'objet log
     *
     * @param string $type Type du log : ACCESS|DB|DEBUG|ERROR|EXEC
     * @param string $content Contenu du log à érire
     */
    public function __construct( $type, $content )
    {

        $this->type = $type;
        $this->content = $content;
        $this->datetime = date( "Ymd-H:i:s" );
        $this->date = date( "Ymd" );
        $this->time = date( "H:i:s" );

        switch ($type) {
            case 'ACCESS':
                $this->write_log_file();
                break;
            case 'DB':
                $this->write_log_file();
                break;
            case 'DEBUG':
                $this->write_log_file();
                break;
            case 'ERROR':
                $this->write_log_file();
                break;
            case 'EXEC':
                $this->write_log_file();
                break;
            default:
                /** Do nothing */
        }


        /** Si $this->result == 'ERROR', envoi d'un email à l'admin */

    }

    /**
     * Ecriture du log dans la base de données de l'application
     *
     * @param void
     * @return void
     */
    private function write_log_db()
    {

        session_start();


        /** On protège l'entrée sql en échappant les quotes */
        $dbh = database::sharedInstance();;
        $this->content = $dbh->protect_entry( $this->content );
        $this->session = serialize( $_SESSION );

        /** Ecriture du log dans la base */
        $this->id = $dbh->insert(
            "INSERT INTO `log`
                     SET `content` = '$this->content',
                         `date`    = NOW()",
            false
        );


    }

    /**
     * Ecriture du log dans un fichier texte date_du_jour-log.txt dans le dossier /__log/
     *
     * @updated 20150925
     * @param void
     * @return void
     */
    private function write_log_file()
    {

        if (ini_get( 'safe_mode' )) {

            //
        } else {

            /** Formatage de la ligne à ajouter */
            $strSearch = array( "<br>", "<br/>", "<br />", "\r\n", "\r", "\n" );
            $strReplace = ' ';
            $this->content = str_replace( $strSearch, $strReplace, $this->content );
            if ($this->type == 'ERROR') {
                $this->content = "[{$this->date}-{$this->time}] [{$_SERVER['REQUEST_URI']}] {$this->content}\r\n";
            } else {
                $this->content = "[{$this->date}-{$this->time}] {$this->content}\r\n";
            }

            if (!is_dir( $_SERVER['DOCUMENT_ROOT'] . "/__log/" . $this->date )) {
                exec( "mkdir -m0777 -p " . $_SERVER['DOCUMENT_ROOT'] . "/__log/" . $this->date );
            }

            /** Ecriture du log dans le fichier log.txt ouvert en mode 'a' (append) */
            $handle = @fopen( $_SERVER['DOCUMENT_ROOT'] . "/__log/{$this->date}/{$this->date}-{$this->type}-log.txt", "ab" );
            if ($handle) {
                @fwrite( $handle, $this->content );
            }
            @fclose( $handle );
        }
    }

    /**
     * Envoi du log par email si une erreur est survenue
     *
     * @param void
     * @return void
     */
    private function send_log_by_email()
    {

        define( __BR__, "<br>" );

        /** Envoi de l'email à l'admin */
        $subject = $_SESSION['system']['system_name'] . " : une erreur est survenue !";
        $message = "Bonjour," . __BR__ . __BR__
            . "Voici le détail de l'erreur :" . __BR__ . __BR__
            . "Date : <b>" . $this->datetime . "</b>" . __BR__
            . "Utilisateur : <b>" . $_SESSION['user']['UID'] . "</b>" . __BR__
            . "Id session : <b>" . session_id() . "</b>" . __BR__
            . "Action : <b>" . $this->action . "</b>" . __BR__
            . "Valeur : <b>" . $this->value . "</b>" . __BR__
            . "Détail : <b>" . stripslashes( $this->detail ) . "</b>" . __BR__ . __BR__
            . "Cette erreur est enregistrée sous l'<b>id " . $this->id . "</b> dans la base de données table <b>:: log ::</b> ." . __BR__ . __BR__
            . "Bonne journée";


        new email( null, $message, $subject, $message, false );
    }

}