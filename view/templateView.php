<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>Приложение для пункта выдачи</title>

  <style>
   article, aside, details, figcaption, figure, footer,header,
   hgroup, menu, nav, section { display: block; }
  </style>
 </head>
 <body>
  <p>Шапка вьюхи</p>

    <!-- вьюха в зависимости от контроллера -->
    <?php
    self::render();
    ?>
    <!-- вьюха в зависимости от контроллера -->

  <p>Подвал вьюхи</p>
 </body>
</html>