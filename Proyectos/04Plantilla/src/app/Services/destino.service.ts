import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { Observable } from 'rxjs';
import { IDestino } from '../Interfaces/destino.interface';

@Injectable({
  providedIn: 'root'
})
export class DestinoService {
  apiurl = 'http://localhost/Sexto/gias2/Sexto/Proyectos/03MVC/controllers/destino.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IDestino> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IDestino>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IDestino[]> {
    return this.lector.get<IDestino[]>(this.apiurl + 'todos');
  }
  uno(destino_id: string): Observable<IDestino> {
    const formData = new FormData();
    formData.append('destino_id', destino_id);
    return this.lector.post<IDestino>(this.apiurl + 'uno', formData);
  }
  eliminar(destino_id: string): Observable<number> {
    const formData = new FormData();
    formData.append('destino_id', destino_id);
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(destino: IDestino): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', destino.nombre);
    formData.append('pais', destino.pais);
    formData.append('descripcion', destino.descripcion);
    formData.append('costo', destino.costo);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(destino: IDestino): Observable<string> {
    const formData = new FormData();
    formData.append('destino_id', destino.destino_id);
    formData.append('nombre', destino.nombre);
    formData.append('pais', destino.pais);
    formData.append('descripcion', destino.descripcion);
    formData.append('costo', destino.costo);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
