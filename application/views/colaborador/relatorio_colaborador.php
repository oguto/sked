 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosColaborador))){ ?>

       <h1> Relatório De Colaborador</h1>

        <ul class="filtro">
          <?php if(!empty($dadosColaborador['email'])){ ?>
               <li>
                 <b>Email</b>
                <?php  echo $dadosColaborador['email']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosColaborador['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['nascimento'])){ ?>
               <li>
                 <b>Nascimento</b>
                <?php  echo $dadosColaborador['nascimento']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['cpf'])){ ?>
               <li>
                 <b>Cpf</b>
                <?php  echo $dadosColaborador['cpf']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['telefone'])){ ?>
               <li>
                 <b>Telefone</b>
                <?php  echo $dadosColaborador['telefone']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['cep'])){ ?>
               <li>
                 <b>Cep</b>
                <?php  echo $dadosColaborador['cep']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['numero'])){ ?>
               <li>
                 <b>Número</b>
                <?php  echo $dadosColaborador['numero']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['responsavel'])){ ?>
               <li>
                 <b>Responsavel</b>
                <?php  echo $dadosColaborador['responsavel']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['endereco'])){ ?>
               <li>
                 <b>Endereço</b>
                <?php  echo $dadosColaborador['endereco']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['comissao'])){ ?>
               <li>
                 <b>Comissão</b>
                <?php  echo $dadosColaborador['comissao']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['senha'])){ ?>
               <li>
                 <b>Senha</b>
                <?php  echo $dadosColaborador['senha']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosColaborador['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosColaborador['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Colaborador </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Email</td>
    <td>Nome</td>
    <td>Nascimento</td>
    <td>Cpf</td>
    <td>Telefone</td>
    <td>Cep</td>
    <td>Número</td>
    <td>Responsavel</td>
    <td>Endereço</td>
    <td>Comissão</td>
    <td>Senha</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaColaborador)){?>
    <?php foreach ($listaColaborador as $dadosColaborador){?>
      <tr>
        <td><?php  echo $dadosColaborador['email']; ?></td>
        <td><?php  echo $dadosColaborador['nome']; ?></td>
        <td><?php  echo $dadosColaborador['nascimento']; ?></td>
        <td><?php  echo $dadosColaborador['cpf']; ?></td>
        <td><?php  echo $dadosColaborador['telefone']; ?></td>
        <td><?php  echo $dadosColaborador['cep']; ?></td>
        <td><?php  echo $dadosColaborador['numero']; ?></td>
        <td><?php  echo $dadosColaborador['responsavel']; ?></td>
        <td><?php  echo $dadosColaborador['endereco']; ?></td>
        <td><?php  echo $dadosColaborador['comissao']; ?></td>
        <td><?php  echo $dadosColaborador['senha']; ?></td>
        <td><?php  echo dataBR($dadosColaborador['data']); ?></td>
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
