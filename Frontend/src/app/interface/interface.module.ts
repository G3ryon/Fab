import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';



@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})
export class InterfaceModule { }
export interface PrintInfo {
  "PrintFilename": string;
  "id": number;
  "Nom": string;
  "Temps": number;
  "Matiere": string;
  "Prix": string;
  "Heure": number;
  "Utilisateur": utilisateur[];

}
export interface utilisateur{
  "id": number;
  "nom": string;
  "prenom":  string;
}
export class Print{
  constructor(
  public Noma: number,
  public Date: string,
  public Nom: string,
  public Temps: string,
  public Matiere: string,
  public Prix: number,
  public Heure: number,
  public PrintFilename: string

  ) {

  }

}
export interface uploadfile{
  "filename": string;
}
export interface PrintForm{
  "code": number;
}
