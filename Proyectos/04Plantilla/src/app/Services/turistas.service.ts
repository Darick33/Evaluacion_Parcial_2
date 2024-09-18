import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { Observable } from 'rxjs';
import { ITurista } from '../Interfaces/turistas.interface';

@Injectable({
  providedIn: 'root'
})
export class TuristaService {
  apiurl = 'http://localhost/Sexto/gias2/Sexto/Proyectos/03MVC/controllers/turistas.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<ITurista> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<ITurista>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<ITurista[]> {
    return this.lector.get<ITurista[]>(this.apiurl + 'todos');
  }
  uno(turista_id: string): Observable<ITurista> {
    const formData = new FormData();
    formData.append('turista_id', turista_id);
    return this.lector.post<ITurista>(this.apiurl + 'uno', formData);
  }
  eliminar(turista_id: string): Observable<number> {
    const formData = new FormData();
    formData.append('turista_id', turista_id);
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(turista: ITurista): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', turista.nombre);
    formData.append('apellido', turista.apellido);
    formData.append('email', turista.email);
    formData.append('telefono', turista.telefono);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(turista: ITurista): Observable<string> {
    const formData = new FormData();
    formData.append('turista_id', turista.turista_id);
    formData.append('nombre', turista.nombre);
    formData.append('apellido', turista.apellido);
    formData.append('email', turista.email);
    formData.append('telefono', turista.telefono);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
