<div class="container">
    <h2>Ask Question</h2>

    <form id="question-form" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="title" class="col-sm-1 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="Title">
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-1 control-label">Category</label>
            <div class="col-sm-10">
                <select id="category">
                    <?php
                    if ($categories) {
                        foreach ($categories as $category) {
                    ?>
                            <option value="<?= $category->name ?>"><?= $category->name ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-1 control-label">Description</label>
            <div class="col-sm-10">
                <textarea rows="5" class="form-control" id="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <a id="submit-btn" class="btn btn-success">Post</a>
            </div>
        </div>
    </form>
</div>

<script>
    let Question = Backbone.Model.extend({
        defaults: {
            title: '',
            category: '',
            description: ''
        },

        validate: function(attributes) {
            if (!attributes.title) {
                return 'Title is required';
            }
        },

        url: '<?= base_url() ?>index.php/question/question'
    });

    let QuestionFormView = Backbone.View.extend({
        el: '#question-form',

        events: {
            'click #submit-btn': 'submitQuestion'
        },

        submitQuestion: function() {
            let question = new Question({
                title: this.$('#title').val(),
                category: this.$('#category').val(),
                description: this.$('#description').val()
            });

            question.save({}, {
                success: function(model, response) {
                    window.location.href = '<?= base_url() ?>index.php/question/question/id/' + response.id;
                },
                error: function(model, response) {
                    console.log(response.error);
                }
            });
        }
    });

    let questionFormView = new QuestionFormView();
</script>