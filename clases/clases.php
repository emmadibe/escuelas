<?php 


class Flasher 
{

  private $valid_types = ['primary','secondary','success','danger','warning','info','light','dark'];
  private $default = 'primary';
  private $type;
  private $msg;

  /**
   * Método para guardar una notificación flash
   *
   * @param string array $msg
   * @param string $type
   * @return void
   */
  public static function new($msg, $type = null)
  {
    $self = new self();

    // Setear el tipo de notificación por defecto
    if($type === null) {
      $self->type = $self->default;
    }

    $self->type = in_array($type, $self->valid_types) ? $type : $self->default;

    // Guardar la notificación en un array de sesión
    if(is_array($msg)) {
      foreach ($msg as $m) {
        $_SESSION[$self->type][] = $m;
      }

      return true;
    }

    //$_SESSION['primary']['notificaciones'];
    $_SESSION[$self->type][] = $msg;

    return true;
  }

  /**
   * Renderiza las notificaciones a nuestro usuario
   *
   * @return void
   */
  public static function flash()
  {
    $self = new self();
    $output = '';

    foreach ($self->valid_types as $type) {
      if(isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
        foreach ($_SESSION[$type] as $m) {
          $output .= '<div class="alert alert-'.$type.' alert-dismissible show fade" role="alert">';
          $output .= $m;
          $output .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>';
          $output .= '</div>';
        }

        unset($_SESSION[$type]);
      }
    }
    
    return $output;
  }

  /**
   * Muestra un mensaje de acceso denegado
   *
   * @return void
   */
  public static function deny($type = 0)
  {
    $types =
    [
      0 => 'Acceso no autorizado.',
      1 => 'Acción no autorizada.',
      2 => 'Permisos denegados.',
      3 => 'No puedes realizar esta acción.'
    ];

    self::new($types[$type], 'danger');
    return true;
  }
} 

class Redirect
{
  private $location;

  /**
   * Método para redirigir al usuario a una sección determinada
   *
   * @param string $location
   * @return void
   */
  public static function to($location)
  {
    $self = new self();
    $self->location = $location;

    // Si las cabeceras ya fueron envíadas
    if (headers_sent()) {
      echo '<script type="text/javascript">';
      echo 'window.location.href="'.URL.$self->location.'";';
      echo '</script>';
      echo '<noscript>';
      echo '<meta http-equiv="refresh" content="0;url='.URL.$self->location.'" />';
      echo '</noscript>';
      die();
    } 

    // Cuando pasamos una url externa a nuestro sitio
    if (strpos($self->location, 'http') !== false) {
      header('Location: '.$self->location);
      die();
    }

    // Redirigir al usuario a otra sección
    header('Location: '.URL.$self->location);
    die();
  }

  /**
   * Redirige de vuelta a la URL previa
   *
   * @param string $location
   * @return void
   */
  public static function back($location = '')
  {
    if(!isset($_POST['redirect_to']) && !isset($_GET['redirect_to']) && $location == ''){
      header('Location: '.URL.DEFAULT_CONTROLLER);
      die();
    }

    if(isset($_POST['redirect_to'])){
      header('Location: '.$_POST['redirect_to']);
      die();
    }

    if(isset($_GET['redirect_to'])){
      header('Location: '.$_GET['redirect_to']);
      die();
    }

    if(!empty($location)){
      self::to($location);
    }
  }
}