import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class AuthService {

  private static tokenId:string = 'com.marcohern.auth.token';

  private token:string = null;
  private isAuthenticated = false;

  constructor(private http:HttpClient) { }

  public setToken(token:string) {
    this.token = token;
    window.sessionStorage.setItem(AuthService.tokenId, token);
    this.isAuthenticated = true;
  }

  public loadToken() {
    this.token = window.sessionStorage.getItem(AuthService.tokenId);
    if (this.token != null && this.token != ''){
      this.isAuthenticated = true;
    } else {
      this.token = null;
      this.isAuthenticated = false;
    }
  }

  public authenticated():boolean {
    return this.isAuthenticated;
  }

  public getToken():string {
    return this.token;
  }

  private getHeaders() {
    var headers:HttpHeaders = new HttpHeaders();
    if (this.token != null) {
      headers.append("Authentication", "Bearer " + this.token);
    }
    return headers;
  }

  public get(url:string):Observable<any> {
    return this.http.get(url, {
      headers: this.getHeaders()
    });
  }

  public post(url:string, data:any):Observable<any> {
    return this.http.post(url, data, {
      headers:this.getHeaders()
    });
  }
}
