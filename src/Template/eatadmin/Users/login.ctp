<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create('login',[
                'class' => 'form-horizontal form-material'
            ]) ?>
            <div class="form-group ">
                <div class="col-xs-12">
                    <?= $this->Form->input('username',
                        [
                            'type' => 'text',
                            'class' => 'form-control',
                            'required' => 'true',
                            'placeholder' => 'Enter username'
                        ]
                    ) ?>
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-12">
                    <?= $this->Form->input('password',[
                        'type' => 'text',
                        'class' => 'form-control',
                        'required' => 'true',
                        'type' => 'password',
                        'placeholder' => 'Enter password'
                    ]) ?>
                </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <?= $this->Form->submit('Login',[
                        'class' => 'btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light'
                    ]); ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section>