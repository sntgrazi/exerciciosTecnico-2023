import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-discussoes',
  templateUrl: './discussoes.component.html',
  styleUrls: ['./discussoes.component.scss']
})
export class DiscussoesComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  mostrarFormulario = false; // Variável para controlar a exibição do formulário
  enviadoComSucesso: boolean = false;
  mostrarCard: boolean = false;
  cardExpandido: boolean = false;

  // Função para alternar a exibição do formulário
  toggleFormulario() {
    this.mostrarFormulario = !this.mostrarFormulario;
  }

  enviarFormulario() {
    // Lógica para enviar o formulário (pode ser uma chamada HTTP)
    // Após o envio bem-sucedido, defina enviadoComSucesso como true
    this.enviadoComSucesso = true;
    this.mostrarCard = true;
    this.mostrarFormulario = false;
  }

  criarOutroTopico() {
    // Reinicie o estado do formulário
    this.mostrarFormulario = false;
    this.enviadoComSucesso = false;
    
    // Mostrar o discussoes-info novamente
    this.toggleFormulario();
  }

  toggleCardExpandido() {
    this.cardExpandido = !this.cardExpandido;
  }

}
