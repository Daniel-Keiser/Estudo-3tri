<!-- Uma belezinha nunca faz mal --> 
<body style="background: url(https://avatars.mds.yandex.net/get-pdb/812271/29fc2ede-3e67-436c-a7f9-5c243548baf4/orig);max-height: auto; padding: 5%; text-align: center; font-weight: 900; font-size: 25px; line-height: 60px; float: right; margin-right: : 10%; margin-top: 10%;">

<?php

//Aqui será criado o objeto Conta, sendo ele abstract e podendo passar seus parametros como herança.
abstract class Conta
{
	protected $agencia;
	protected $conta;
	protected $saldo;

	public function __construct ($agencia, $conta, $saldo)
	{
		$this ->agencia = $agencia; 
		$this ->conta   = $conta;
		$this ->saldo   = $saldo;
	} 

	public function getDetalhes()
	{
		return "Agencia: {$this->agencia} |
		        Conta:   {$this->conta}   |
		        Saldo:   {$this->saldo}     
		        <br />";
	}
//Cria a função para depositar dinheiro na conta.
	public function depositar($valor)
	{
		$this ->saldo += $valor;
			echo "Deposito de: {$valor} |
		          Saldo atual: {$this->saldo} <br /> ";
	}
}
//Aqui será criado o objeto Poupança, porêm para não ter que criado as classes de novo, usei as mesmas classes da Conta (extends).
//Não funciona se der valor negativo.
final class Poupanca extends Conta
{
	public function saque($valor)
	{
		if($this->saldo >= $valor):
		$this->saldo -= $valor;

			echo "Saque de: {$valor} |
			      Saldo atual de: {$this->saldo} <br /> ";
		else:
			echo "Saque não autorizado de: {$valor} |
			      Saldo atual de: {$this->saldo} <br /> ";
		endif;	
	}
}
//Aqui será criado o objeto Corrente, servirá para fazer o limite do que o usuário pode ficar no negativo com o banco.
//Da mesma forma, foi pego de herança as classes da Conta (extends).
final class Corrente extends Conta
{
	protected $limite;
	public function __construct($agencia, $conta, $saldo, $limite)
	{
		parent:: __construct($agencia, $conta, $saldo);
		$this->limite = $limite;
	}
//Função para se fazer o saque.
	public function saque($valor)
	{
	if(($this->saldo + $this->limite) >= $valor):
	$this->saldo -= $valor;

		echo "Saque de: {$valor} |
			  Saldo atual de: {$this->saldo} <br /> ";
	else:
		echo "Saque não autorizado de: {$valor} |
		      Saldo atual de: {$this->saldo} <br /> ";
	endif;	
    }
}
//Aqui ta sendo colocado os valores de forma manual.
$c1 = new Corrente(100, 2500, 4000, 1500);
echo $c1->getDetalhes();
$c1->depositar(1500);
$c1->saque(5700);

?>
</body>