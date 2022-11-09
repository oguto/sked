 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosCliente))){ ?>

       <h1> Relatório De Cliente</h1>

        <ul class="filtro">
          <?php if(!empty($dadosCliente['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosCliente['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['telefone'])){ ?>
               <li>
                 <b>Telefone</b>
                <?php  echo $dadosCliente['telefone']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['email'])){ ?>
               <li>
                 <b>Email</b>
                <?php  echo $dadosCliente['email']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['nascimento'])){ ?>
               <li>
                 <b>Nascimento</b>
                <?php  echo $dadosCliente['nascimento']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['cep'])){ ?>
               <li>
                 <b>Cep</b>
                <?php  echo $dadosCliente['cep']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['numero'])){ ?>
               <li>
                 <b>Número</b>
                <?php  echo $dadosCliente['numero']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['endereco'])){ ?>
               <li>
                 <b>Endereço</b>
                <?php  echo $dadosCliente['endereco']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['responsavel'])){ ?>
               <li>
                 <b>Responsavel</b>
                <?php  echo $dadosCliente['responsavel']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['contato_responsavel'])){ ?>
               <li>
                 <b>Contato responsavel</b>
                <?php  echo $dadosCliente['contato_responsavel']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['senha'])){ ?>
               <li>
                 <b>Senha</b>
                <?php  echo $dadosCliente['senha']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosCliente['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosCliente['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Cliente </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Nome</td>
    <td>Telefone</td>
    <td>Email</td>
    <td>Nascimento</td>
    <td>Cep</td>
    <td>Número</td>
    <td>Endereço</td>
    <td>Responsavel</td>
    <td>Contato responsavel</td>
    <td>Senha</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaCliente)){?>
    <?php foreach ($listaCliente as $dadosCliente){?>
      <tr>
        <td><?php  echo $dadosCliente['nome']; ?></td>
        <td><?php  echo $dadosCliente['telefone']; ?></td>
        <td><?php  echo $dadosCliente['email']; ?></td>
        <td><?php  echo $dadosCliente['nascimento']; ?></td>
        <td><?php  echo $dadosCliente['cep']; ?></td>
        <td><?php  echo $dadosCliente['numero']; ?></td>
        <td><?php  echo $dadosCliente['endereco']; ?></td>
        <td><?php  echo $dadosCliente['responsavel']; ?></td>
        <td><?php  echo $dadosCliente['contato_responsavel']; ?></td>
        <td><?php  echo $dadosCliente['senha']; ?></td>
        <td><?php  echo dataBR($dadosCliente['data']); ?></td>
        </tr>
    <?php }?>
  <?php }else{?>
    <tr colspan="<?php  echo $colunas; ?>">
      <td>Nenhum registro foi encontrado</td>
    </tr>
  <?php }?>
   <tr >
    <td colspan="<?php  echo $colunas; ?>"><b>Total: <?php  echo $total; ?></b></td>
  </tr>
</table>
