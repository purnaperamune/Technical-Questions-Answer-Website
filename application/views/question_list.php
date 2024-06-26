<div class="container">
    <?php
    echo '<h2>' . $header . '</h2>';
    if ($questions) {
        foreach ($questions as $question) {
    ?>
            <div class="row question-container">
                <div class="col-md-1">
                    <div class="status-container">
                        <div class="row center-content"><span class="badge status-answer-count"><?= $question->upvoteCount ?></span></div>
                        <div class="row center-content"><span class="status-answer-text">Votes</span></div>
                    </div>
                </div>

                <div class="col-md-1" style="margin-left: -15px">
                    <div class="status-container">
                        <div class="row center-content"><span class="badge status-answer-count"><?= $question->answerCount ?></span></div>
                        <div class="row center-content"><span class="status-answer-text">Answers</span></div>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="row"><a href="<?= base_url() ?>index.php/question/question/id/<?= $question->id ?>"><strong><?= $question->title ?></strong></a></div>
                    <div class="row"><?= $question->description ?></div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <a href="<?= base_url() ?>index.php/question/question/category/<?= $question->category ?>">
                                    <div class="label label-default tag-container"><?= $question->category ?></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row username-text"><a href=""><?= $question->username ?></a></div>
                            <div class="row username-text"><?= $question->created_at ?></div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>