<div class="container-full <?php if (isset($MenuCurrentCompany) && !empty($MenuCurrentCompany)): ?>margin-top-fix<?php endif; ?>">
    <div class="row">
        <div class="header col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="but_image hidden-sm hidden-xs"></div>
            <div class="grey_box text">
                EZYcount est un <b>programme de comptabilité</b> Suisse accessible par internet pour les petites entreprises.
            </div>
            <div class="bikes_image">
               <div class="tip hidden-xs">
                    <div class="text_tip">
                        Maintenant, je profite de mes weekends!
                    </div>
                </div>
                <div class="corner_t hidden-xs corner_t_reverse"></div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="clearfix"></div>

        <div class="brown_buttons hidden-xs">
        <a href="#easy">
            <div
                class="brown_but col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                Facile, Sûr et Accessible
                <!--div class="tip">
                    <div class="text_tip">
                        "Maintenant, je peux profiter de mes weekends pour faire ce que j'aime."
                    </div>
                </div>
                <div class="corner">
                    <img src="images/or_corner_n.png" alt=""/>
                </div-->
            </div>
        </a>
            <a href="#des">
            <div
                class="brown_but col-lg-2 col-lg-offset-0 col-md-2 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                pour&nbsp;les&nbsp;petites&nbsp;entreprises
            </div>
            </a>
            <a href="#prix">
            <div
                class="brown_but col-lg-2 col-lg-offset-0 col-md-2 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                Dès CHF 9.90 / mois
                <!--div class="tip">
                    <div class="text_tip">
                        "Maintenant, je peux profiter de mes weekends pour faire ce que j'aime,"
                    </div>
                </div>
                <div class="corner">
                    <img src="images/or_corner_n.png" alt=""/>
                </div-->
            </div>
            </a>
        </div>

        <div class="clearfix"></div>

        <div class="info_block"><a id="facile" class="anchor"></a>
            <div
                class="image_part col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <?php echo $this->Html->image('image_1.png'); ?>
            </div>
            <div
                class="text_part col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <h3>Facile. Sûr. <span>Accessible.</span></h3>

                <div>
                    Votre comptabilité est simplifiée grâce à des aides visuelles et des fonctions intuitives. 
                    Vos données comptables sont enregistrées en temps réel sur des serveurs en Suisse, garantissant le maximum de sécurité et confidentialité. 
                    Vous accédez à vos données comptables avec une connexion internet sur votre ordinateur,
                     tablette ou téléphone.<br><br>
                </div>
                <?php echo $this->Html->link('PLUS DE DETAILS', '/pages/solution#availability', array('class' => 'see_more')); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="info_block"><a id="des" class="anchor"></a>
            <div
                class="image_part hidden-lg hidden-md hidden-sm col-xs-10 col-xs-offset-1">
                <?php echo $this->Html->image('image_2.jpg'); ?>
            </div>
            <div
                class="text_part col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <h3>Pour les<span> petites entreprises et start-ups.</span></h3>

                <div>
                    <b>EZYcount</b> propose toutes les fonctions essentielles de la comptabilité dont vous avez besoin: Ecritures comptables,
                    bilan, compte de pertes et profits (et autres rapports comptables), TVA, et accès simultanés à autant de personnes que vous le souhaitez. Vous serez guidé à travers chaque étape de votre comptabilité grâce à des boutons d'aides.
                    Vous visualisez vos rapports comptables en temps réel, les personalisez et les partagez avec qui vous souhaitez.<br><br>
                </div>
                <?php echo $this->Html->link('PLUS DE DETAILS', '/pages/solution', array('class' => 'see_more')); ?>
            </div>
            <div
                class="image_part col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-5 col-sm-offset-1 hidden-xs">
                <?php echo $this->Html->image('image_2.jpg'); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="info_block"><a id="one" class="anchor"></a>
            <div
                class="image_part col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <?php echo $this->Html->image('image_3.jpg'); ?>
            </div>
            <div
                class="text_part col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <h3><span>Economique</span></h3>

                <div>
                    Dès <b>CHF 9.90</b> par mois et par entreprise tout compris, sans limite d'utilisateurs.</br>Pas de coûts cachés, pas de mauvaises surprises, que des avantages. Enregistrez-vous gratuitement et beneficiez de <b>30 jours de test gratuit pour votre entreprise.</b><br><br>
                </div>
                <?php echo $this->Html->link('PLUS DE DETAILS', '/pages/solution#price', array('class' => 'see_more')); ?>
            </div>
        </div>
    </div>


<script type="text/javascript">
  $(document).ready(function(){
     // Scroll page with easing effect
    $('.brown_buttons a').bind('click', function(e) {
        e.preventDefault();
        target = this.hash;
        $.scrollTo(target, 1500, {
          easing: 'easeOutCubic'
        });
    });
  });
</script>



