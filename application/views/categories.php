<style>
    .card {
        border: 1px solid #ccc;
        margin-bottom: 15px;
        border-radius: 6px;
        border-color: #007bff;
        background-color: #f8f9fa;
    }

    .card-header,
    .card-footer {
        padding: 10px;
    }

    .card-body {
        padding: 15px;
    }

    .col-md-4 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .label-hover:hover {
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="row">
        <h2 style="padding-left: 15px">All Categories</h2>

        <?php if ($categories) {
            $colors = array('#ff1b1e', '#007c89', '#e8c742', '#2f3c52', '#32cd32', '#189bcc');

            foreach ($categories as $category) {
                $randomColor = $colors[array_rand($colors)]; ?>

                <div class="col-md-4">
                    <div class="card" style="border-color: <?= $randomColor ?>">
                        <a href="<?= base_url() ?>index.php/question/question/category/<?= $category->name ?>">
                            <div class="card-header">
                                <span class="label label-primary label-hover">
                                    <?= $category->name ?>
                                </span>
                            </div>
                        </a>

                        <div class="card-body">
                            <?= $category->description ?>
                        </div>

                        <div class="card-footer">
                            <?= $category->questionCount ?> questions
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>