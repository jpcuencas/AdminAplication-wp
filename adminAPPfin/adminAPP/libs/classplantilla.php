
<?php
class Plantilla{

        function plantilla($template_file,$carpeta){
                $this->tpl_file = $carpeta . '/' . $template_file . '.tpl';
        }
       
        function asigna_variables($vars){
                $this->vars= (empty($this->vars)) ? $vars : $this->vars . $vars;
        }
       
        function muestra(){
                if (!($this->fd = @fopen($this->tpl_file, 'r'))) {
                        echo('error al abrir la plantilla ' . $this->tpl_file);
                } else{
                        $this->template_file = fread($this->fd, filesize($this->tpl_file));
                        fclose($this->fd);
                        $this->mihtml = $this->template_file;
                        $this->mihtml = str_replace ("'", "\'", $this->mihtml);
                        $this->mihtml = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->mihtml);
                        reset ($this->vars);
                        while (list($key, $val) = each($this->vars)) {
                                $$key = $val;
                        }
                        eval("\$this->mihtml = '$this->mihtml';");
                        reset ($this->vars);
                        while (list($key, $val) = each($this->vars)) {
                                unset($$key);
                        }
                        $this->mihtml=str_replace ("\'", "'", $this->mihtml);
                        return $this->mihtml;
                }
        }
}
?>
