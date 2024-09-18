import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { Observable } from 'rxjs';
import { IReserva } from '../Interfaces/reserva.interface';

@Injectable({
  providedIn: 'root'
})
export class ReservaService {
  apiurl = 'http://localhost/Sexto/gias2/Sexto/Proyectos/03MVC/controllers/reserva.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IReserva> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IReserva>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IReserva[]> {
    return this.lector.get<IReserva[]>(this.apiurl + 'todos');
  }
  uno(reserva_id: string): Observable<IReserva> {
    const formData = new FormData();
    formData.append('reserva_id', reserva_id);
    return this.lector.post<IReserva>(this.apiurl + 'uno', formData);
  }
  eliminar(reserva_id: string): Observable<number> {
    const formData = new FormData();
    formData.append('reserva_id', reserva_id);
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(destino: IReserva): Observable<string> {
    const formData = new FormData();
    formData.append('turista_id', destino.turista_id);
    formData.append('destino_id', destino.destino_id);
    formData.append('fecha_reserva', destino.fecha_reserva);
    formData.append('numero_personas', destino.numero_personas);
    formData.append('costo_final', destino.costo_final);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(destino: IReserva): Observable<string> {
    const formData = new FormData();
    formData.append('reserva_id', destino.reserva_id);
    formData.append('turista_id', destino.turista_id);
    formData.append('destino_id', destino.destino_id);
    formData.append('fecha_reserva', destino.fecha_reserva);
    formData.append('numero_personas', destino.numero_personas);
    formData.append('costo_final', destino.costo_final);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
