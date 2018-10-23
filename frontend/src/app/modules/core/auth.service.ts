import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { LoginResult } from './login-result';
import { Result } from './result';

@Injectable()
export class AuthService {

  private static tokenId:string = 'com.marcohern.auth.token';

  private token:string = null;
  private isAuthenticated = false;
  
  private getHeaders() {
    var headers:HttpHeaders = new HttpHeaders();
    if (this.token != null) {
      headers.append("Authentication", "Bearer " + this.token);
    }
    return headers;
  }

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

  public clearToken() {
    window.sessionStorage.removeItem(AuthService.tokenId);
    this.isAuthenticated = false;
  }

  public authenticated():boolean {
    return this.isAuthenticated;
  }

  public getToken():string {
    return this.token;
  }

  public get<T>(url:string):Observable<T> {
    return this.http.get<T>(url, {
      headers: this.getHeaders()
    });
  }

  public post<T>(url:string, data:any):Observable<T> {
    return this.http.post<T>(url, data, {
      headers:this.getHeaders()
    });
  }

  public login(email:string, password:string): Observable<LoginResult> {
    return this.post<LoginResult>('/api/account/login', {email:email, password:password});
  }

  public logout():Observable<Result> {
    return this.post<Result>('/api/account/logout',{});
  }
}
