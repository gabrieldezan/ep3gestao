    <?php

require_once "Conexao.class.php";

class PerguntasFrequentes extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_perguntas_frequentes;
    private $numero;
    private $pergunta;
    private $resposta;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_perguntas_frequentes === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO perguntas_frequentes (
                        numero,
                        pergunta,
                        resposta
                    ) VALUES (
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->numero",
                    "$this->pergunta",
                    "$this->resposta"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE perguntas_frequentes SET 
                        numero = ?,
                        pergunta = ?,
                        resposta = ?
                    WHERE 
                        id_perguntas_frequentes = ?;
                ');
                $salva_dados->execute(array(
                    "$this->numero",
                    "$this->pergunta",
                    "$this->resposta",
                    "$this->id_perguntas_frequentes"
                ));
                $this->setRetorno_dados($this->id_perguntas_frequentes);
            }
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_dados() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    id_perguntas_frequentes,
                    numero,
                    pergunta
                FROM
                    perguntas_frequentes
            ");
            $consulta_dados->execute();
            if ($consulta_dados->rowCount() > 0):
                $this->setRetorno_dados(json_encode($consulta_dados->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO EDITA DADOS =============== */

    public function edita_dados() {

        try {
            $pdo = parent::getDB();

            $edita_dados = $pdo->prepare("
                SELECT
                    numero,                    
                    pergunta,
                    resposta
                FROM
                    perguntas_frequentes
                WHERE
                    id_perguntas_frequentes =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_perguntas_frequentes"
            ));
            if ($edita_dados->rowCount() > 0):
                $this->setRetorno_dados(json_encode($edita_dados->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_perguntas_frequentes() {
        return $this->id_perguntas_frequentes;
    }

    function getNumero() {
        return $this->numero;
    }

    function getPergunta() {
        return $this->pergunta;
    }

    function getResposta() {
        return $this->resposta;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_perguntas_frequentes($id_perguntas_frequentes) {
        $this->id_perguntas_frequentes = $id_perguntas_frequentes;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setPergunta($pergunta) {
        $this->pergunta = $pergunta;
    }

    function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
