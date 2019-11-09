<section>
    <div class="container">
        <h1 class="font-edgeracer">Cadastro de Veículo</h1>
        <form action="<?= URL_RAIZ . 'frota'?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">directions_car</i>
                    <input id="input-chassi" type="text" name="chassi" value="<?= $this->getPost('chassi') ?>" placeholder="1234cb4321dd34yp9">
                    <label for="icon_prefix">Número do Chassi</label>
                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'chassi']) ?>
                </div>
            </div>
            <div id="div-dados-veiculo">
                <div class="row">
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">build</i>
                        <input type="text" name="montadora" value="<?= $this->getPost('montadora') ?>" placeholder="Fiat">
                        <label for="icon_prefix">Montadora</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">directions_car</i>
                        <input type="text" name="modelo" value="<?= $this->getPost('modelo') ?>"placeholder="Argo">
                        <label for="icon_prefix">Modelo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">filter_list</i>
                        <select name="categoria" value="<?= $this->getPost('categoria') ?>">
                            <option value="1">Hatch</option>
                            <option value="2">Sedãn</option>
                            <option value="3">SUV</option>
                            <option value="4">Pick-Ups</option>
                        </select>
                        <label>Categoria</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">monetization_on</i>
                        <input type="text" name="preco" value="<?= $this->getPost('preco') ?>" placeholder="95,00">
                        <label for="icon_prefix">Preço Diária</label>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'precoDiaria']) ?>
                    </div>
                    <div class="row">
                        <div id="div-imagens-veiculo" class="input-field col s12">
                            <h1>Adicionar Imagem</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12">
                            <input type="file" id="input-imagem" name="foto" value="<?=$this->getPost('foto')?>">
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m12 l6">
                            <button class="waves-effect waves-light btn button-confirmar" type="submit">
                                <i class="material-icons left">check_circle</i>Cadastrar Veículo
                            </button>
                        </div>
                        <div class="col s12 m12 l6">
                            <button class="waves-effect waves-light btn button-cancelar" type="submit">
                                <i class="material-icons left">cancel</i>Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
