import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {Router} from "@angular/router";
import {catchError} from 'rxjs/operators';
import {DatePipe, formatDate} from "@angular/common";
import {Observable} from "rxjs";
import {HttpParams} from "@angular/common/http";
import {PrintInfo,utilisateur,PrintForm, uploadfile} from '../Interface/Interface.module';
@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private http: HttpClient, private router:Router) { }

  private handleError( error: any ) {
    if ( error instanceof Response ) {//Backend Error
      //.json() parsing failed from server
      console.log( "Error:"+error.text() );
      return Observable.throw( error.text() );
    }
    //otherwise the server returned error code status
    return Observable.throw( error );
  }
  //getting the schedule of prints of the chosen day
  getPrintScheduleJson(date){
    let url = "http://127.0.0.1:8000/api/Date";
    let params = new HttpParams().set("date",date);
    return this.http.get<PrintInfo>(url,{params:params}).pipe(catchError(this.handleError));
  };
  //Handling the request to return the file to be downloaded
  downloadGcode(gcodefile){
    let url = "http://127.0.0.1:8000/api/Download?ddl="+gcodefile;
    return window.open(url);
  }
  //Handling the request to send the data to the database
  newPrintSubmit(printInfo){
    let url = "http://127.0.0.1:8000/api/Print";
    let params = new HttpParams()
      .set("Noma",printInfo.Noma)
      .set("Date",formatDate(printInfo.Date,'yyyy-MM-dd',"en-US"))
      .set("Nom",printInfo.Nom)
      .set("Matiere",printInfo.Matiere)
      .set("Prix",printInfo.Prix)
      .set("Heure",printInfo.Heure.substring(0, printInfo.Heure.length - 1))
      .set("Printfile",printInfo.PrintFilename);

    return this.http.get<PrintForm>(url,{params:params}).pipe(catchError(this.handleError));
  }
  //Handling the request to upload the file to the server
  uploadFIle(filedata){
    let url = "https://127.0.0.1:8000/api/up";
    return this.http.post(url, filedata).pipe(catchError(this.handleError));

  }
  //Handling the request to update the formation status of a user
  updateFormation(updateInfo){
    let url = "http://127.0.0.1:8000/api/formationbool";
    let params = new HttpParams()
      .set("Noma",updateInfo.Noma)
      .set("bool",updateInfo.bool);

    return this.http.get<PrintForm>(url,{params:params}).pipe(catchError(this.handleError));
  }
  //Handling the request to delete a print in the database
  deleteprint(id){
    let url = "http://127.0.0.1:8000/api/Delete";
    let params = new HttpParams()
      .set("id",id);

    return this.http.get(url,{params:params}).pipe(catchError(this.handleError));
  }


}
