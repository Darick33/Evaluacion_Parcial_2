export interface IReserva{
    reserva_id: string,
    turista_id: string,
    destino_id: string,
    fecha_reserva: string,
    numero_personas: string,
    turista_nombre?: string,
    destino_nombre?: string,
    destino_costo?: string,
    costo_final: string,
}