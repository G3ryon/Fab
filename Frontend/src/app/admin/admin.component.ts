import { Component, OnInit } from '@angular/core';
import {ApiService} from "../services/api.service";
import { HttpClient } from '@angular/common/http';
import {Router} from "@angular/router";
import {Formationbool, Print} from '../Interface/Interface.module';
@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {
  message = '';
  type ='';
  model = new Formationbool(0,false) ;
  constructor(private api: ApiService) { }

  //handling the request to the API to update the formation status of a user
  onSubmit(){
    this.api.updateFormation(this.model).subscribe(res =>{switch(res["code"]){
      case 200: {
        this.message='SUCCESS!!';
        this.type = "success";
        this.model = new Formationbool(0,false);
        break;
      }
      case 401: {
        this.message='ECHEC du changement ';
        this.type="danger";
        break;
      }
    }})}
  ngOnInit() {
  }

}
