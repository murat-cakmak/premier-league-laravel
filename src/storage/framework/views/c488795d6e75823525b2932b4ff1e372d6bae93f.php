<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PREMIER LEAGUE</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="container">
        <div class="league-table">
            <div class="weekly-title">League Table</div>
            <table class="weekly">
                <thead class="weekly-head">
                    <tr>
                        <td class="team">Team</td>
                        <td class="score">Played</td>
                        <td class="score">Won</td>
                        <td class="score">Draw</td>
                        <td class="score">Lose</td>
                        <td class="score">Points</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($league)): ?>
                    <?php $__currentLoopData = $league; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="team">
                                <img src="<?php echo e(asset('img/'. $lg->logo)); ?>" alt="<?php echo e($lg->name); ?>">
                                <?php echo e($lg->name); ?>

                            </td>
                            <td class="score"><?php echo e($lg->played); ?></td>
                            <td class="score"><?php echo e($lg->won); ?></td>
                            <td class="score"><?php echo e($lg->draw); ?></td>
                            <td class="score"><?php echo e($lg->lose); ?></td>
                            <td class="score"><?php echo e($lg->points); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="match-result">
            <div class="results-title">Match Results</div>
            <table class="results">
                <thead>
                    <tr>
                        <td rowspan="3">1 st Week Match Result</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($matches)): ?>
                        <?php $__currentLoopData = $matches[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="width: 35%"><?php echo e($Match['home_team']); ?></td>
                                <td style="text-align: center">
                                    <?php echo e($Match['home_goal']); ?>

                                    <?php echo e($Match['away_goal']); ?>

                                </td>
                                <td style="width: 35%"><?php echo e($Match['away_team']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="buttons">
            <a href="/play-all" class="play-all-button">Play All</a>
            <a href="/play-week/<?php echo e($league[0]->played + 1); ?>" class="play-week-button">Play Week</a>
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/resources/views/league.blade.php ENDPATH**/ ?>