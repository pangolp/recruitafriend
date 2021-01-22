# Recruit a friend

> English

It is a module that allows you to recruit a friend to have the benefits that the blizzlike emulator offers. Which are, increased experience while in a group. Invoke your friend once every 60 minutes and give him 1 level for each level obtained, up to the default level 60, but this can be modified in the emulator (3.3.5a)

The following routes must be added to the `routes.php` file

```php
/*Recruit Friend*/
$route[$lang.'/recruit'] = 'recruitFriend/index';
$route[$lang.'/recruit/add'] = 'recruitFriend/add';
```

You should also use [SweetAlert2](https://sweetalert2.github.io/) for notifications.

> Español

Es un modulo, que te permite, reclutar un amigo para tener los beneficios que el emulador blizzlike te ofrece. Los cuales son, aumento de experiencia mientras estén en grupo. Invocar a tu amigo, 1 vez cada 60 minutos y otorgarle 1 nivel, por cada nivel obtenido, hasta el nivel 60 por defecto, pero eso se puede modificar en el emulador (3.3.5a)

Se deben de agregar las siguiente rutas al fichero `routes.php`

```php
/*Recruit Friend*/
$route[$lang.'/recruit'] = 'recruitFriend/index';
$route[$lang.'/recruit/add'] = 'recruitFriend/add';
```

También debes utilizar [SweetAlert2](https://sweetalert2.github.io/) para las notificaciones
