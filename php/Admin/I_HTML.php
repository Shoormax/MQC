<?php
/**
 * Interface I_HTML Permet de créer du code HTML
 */

namespace Admin;
interface I_HTML {

  /**
   * @param $echo Boolean Si true, fait un echo HTML, sinon retourne la valeur
   * @return String
   */
  public function HTML($echo = false);
}
