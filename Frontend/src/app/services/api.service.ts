import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {Router} from "@angular/router";
import {catchError} from 'rxjs/operators';
import {Observable} from "rxjs";
import {HttpParams} from "@angular/common/http";
import {PrintInfo,utilisateur} from '../Interface/Interface.module';
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

  getPrintScheduleJson(date){
    let url = "http://127.0.0.1:8000/api/Date";
    let params = new HttpParams().set("date",date);
    return this.http.get<PrintInfo>(url,{params:params}).pipe(catchError(this.handleError));
  };


}
