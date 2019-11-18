<section>
    <div class="container">
        <h1 class="font-edgeracer">Atualizar dados do Veículo</h1>
        
        <?php if (!empty($mensagem)) : ?>
            <div class="msg-flash balao-flash-sucesso">
                <p><?= $mensagem ?></p>
            </div>
        <?php endif ?>

        <?php if (!empty($naoEncontrado)) : ?>
            <div class="msg-flash balao-flash-erro">
                <p><?= $naoEncontrado?></p>
            </div>
        <?php endif ?>

        <form action="<?= URL_RAIZ . 'frota/pesquisar' ?>" method="get">
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">directions_car</i>
                    <input id="input-chassi" type="text" name="chassi-busca" value="<?= $this->getPost('chassi-busca') ?>" placeholder="1234cb4321dd34yp9">
                    <label for="icon_prefix">Número do Chassi</label>
                </div>
                <div class="col s12 m6">
                    <button class="waves-effect waves-light btn button-pesquisar" type="submit">
                        <i class="material-icons left">search</i>Pesquisar
                    </button>
                </div>
            </div>
        </form>

        <?php if (!empty($veiculo)) : ?>
            <form action="<?= URL_RAIZ . 'frota/atualizar/' . $veiculo->getId() ?>" method="post">
                <input type="hidden" name="_metodo" value="PATCH">
                <div class="row">
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">build</i>
                        <input type="text" name="montadora" value="<?= $veiculo->getMontadora() ?>" placeholder="Fiat">
                        <label for="icon_prefix">Montadora</label>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'montadora']) ?>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">directions_car</i>
                        <input type="text" name="modelo" value="<?= $veiculo->getModelo() ?>" placeholder="Argo">
                        <label for="icon_prefix">Modelo</label>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'modelo']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">directions_car</i>
                        <input type="text" disabled value="<?= $categoria ?>">
                        <label>Categoria Atual</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">filter_list</i>
                        <select name="categoria">
                            <option value="" disabled selected>Selecionar Categoria</option>
                            <option value="1">Hatch</option>
                            <option value="2">Sedãn</option>
                            <option value="3">SUV</option>
                            <option value="4">Pick-Ups</option>
                        </select>
                        <label>Mudar Categoria</label>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">monetization_on</i>
                        <input type="text" name="precoDiaria" value="<?= $veiculo->getPrecoDiaria() ?>" placeholder="95,00">
                        <label for="icon_prefix">Preço Diária</label>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'precoDiaria']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m12 l6">
                        <button class="waves-effect waves-light btn button-confirmar" type="submit">
                            <i class="material-icons left">check_circle</i>Confirmar Alterações
                        </button>
                    </div>
                    <div class="col s12 m12 l6">
                        <button class="waves-effect waves-light btn button-cancelar" type="submit">
                            <i class="material-icons left">cancel</i>Cancelar
                        </button>
                    </div>

                </div>
    </div>
    </form>
<?php endif ?>
</div>
</section>