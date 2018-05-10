<?php

passthru(sprintf(
  'php "%s/console" doctrine:fixtures:load --env=test --fixtures=%s --no-interaction',
  __DIR__,
  join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'src', 'AppBundle', 'DataFixtures'])
));

require __DIR__.'/bootstrap.php.cache';
