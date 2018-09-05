import React, { Component } from 'react'
import axios from 'axios';

class SinodaliasTable extends Component {
	constructor(props) {
		super(props)
		this.state = {
			sinodalias: [],
			teachers: [],
			periodosAct: [],
			periodoSeleccionado: 0,
			ready: false,
		}

		// bindings
		this.compareTeaching = this.compareTeaching.bind(this)
		this.getSinodaliasData = this.getSinodaliasData.bind(this)
		this.linked = this.linked.bind(this)
		this.pullPeriodo = this.pullPeriodo.bind(this)
	}

	// traer las sinodalias
		componentWillMount () {
			this.getPeriodosAbiertos()
			this.getSinodaliasData()
			// last
			this.getTeachersData()
		}

		componentDidMount() {
			// actualizar cada 10 segundos
			this.interval = setInterval(() => this.getSinodaliasData(), 10000)
		}

		componentWillUnmount() {
			// limpiar el montaje
			clearInterval(this.interval)
		}

		getSinodaliasData() {
			axios.get('/sinodalias')
			.then((response) => {
				console.log(response)
				let sinodaliasList = response.data.sinodalias
				let validSinodalias = []
				sinodaliasList.map((sinodal) => {
					(sinodal.periodo_id == this.state.periodoSeleccionado) && validSinodalias.push(sinodal)

				})
				this.setState({
					sinodalias: [...validSinodalias],
				})
			})
			.catch(error => {
  			console.log(error.message);
			})
		}

		getTeachersData() {
		axios.get('/teachers')
		.then((response) => {
					console.log("done")
					this.setState({
						teachers: [...response.data.teachers],
					})
				}
			)
		}

		compareTeaching(sinodal) {
			let teacher= ''
			// buscando el maestro que corresponde al id
			for(let i = 0; i < this.state.teachers.length; i++){
				if (this.state.teachers[i].id == sinodal) {
					teacher = this.state.teachers[i].name
				}
			}
			return teacher
		}

		// link manual
		linked(id){
			return '/sinodalias/'+id
		}

		// cargar los periodos para filtrar las sinodalias
		getPeriodosAbiertos() {
			axios.get('/periodosDisponibles')
			.then((response) => {
				this.setState({
					periodosAct: [...response.data.periodosActivos],
					periodoSeleccionado: response.data.periodosActivos[0].id,
					ready: true,
				})
			})
		}

		// renderiza la tabla completa, puede llamarse
		showTableContent() {
			return (
					this.state.sinodalias.map((sinodalia, key) => (
					  			<tr key={sinodalia.id}>
					  				<td>{key+1}</td>
							      <th scope="row">{sinodalia.residente}</th>
							      <td>{sinodalia.proyecto}</td>
							      <td>{sinodalia.carrera}</td>
							      <td>{sinodalia.num_control}</td>
							      <td>{this.compareTeaching(sinodalia.user_id)}</td>
							      <td>{this.compareTeaching(sinodalia.id_secretario)}</td>
							      <td>{this.compareTeaching(sinodalia.id_vocal)}</td>
							      <td>{this.compareTeaching(sinodalia.id_vocal_sup)}</td>
							      <td>
							      <a href={this.linked(sinodalia.id)} className="btn btn-success">
							      			Editar</a>
							      { sinodalia.proyecto_aprobacion ? " ✔" : ""}
							      { sinodalia.aprobacion ? " ✔" : ""}
							      </td>
							    </tr>
					  		))
				)
		}

		// se trae los datos del formulario para el filtro
		// por periodo
		pullPeriodo() {
			let id = document.getElementById("periodos-form")

			// cambiando il id del periodo para mostrarlos
			this.setState({
				periodoSeleccionado: id.value,
			})
			console.log("pullPeriodo: "+id.value)
			// peticion axios para traerse todos los datos
			this.getSinodaliasData()
		}

	render() {
		return (
				<div>
					<div>
						<h2 className="text-center">Lista de Sinodalías creadas</h2>
						<br/>
					</div>
					<div className="row">
						<div className="col-md-5">
							<form action="">
							<div className="form-group">
							<label htmlFor="periodos-form">Selección de Periodo(solo disponibles)</label>
							<select id="periodos-form" name="periodos-form" className="form-control">
								{ this.state.ready ? this.state.periodosAct.map((periodo) => (
										<option key={ periodo.id } value={ periodo.id }>{ periodo.name }</option>
									)) : <option>No disponible</option> }
							</select>
							</div>
						</form>
						
							<div className="row">
								<div className="col-md-8">
								</div>
								<div className="col-md-2">
									<button className="btn btn-secondary "
											onClick={() => this.pullPeriodo()}>
											Filtrar periodo</button>
								</div>
							</div>
						</div>
						<div className="col-md-3">
							
						</div>
					</div>
					<br/>
					<table className="table">
						<thead className="thead-dark">
					    <tr>
					    	<th scope="col">#</th>
					      <th scope="col">Residente</th>
					      <th scope="col">Proyecto</th>
					      <th scope="col">Carrera</th>
					      <th scope="col">N.de Control</th>
					      <th scope="col">Presidente</th>
					      <th scope="col">Secretario</th>
					      <th scope="col">Vocal</th>
					      <th scope="col">Vocal Suplente</th>
					      <th scope="col">Aprobaciones</th>
					    </tr>
					  </thead>
					  <tbody>
					  	{ this.showTableContent() }
					  </tbody>
					</table>
					{ this.state.sinodalias.length == 0 &&
						<div style={{ width:800, fontSize:35, marginLeft:300 }}>
			  			<div className="alert alert-danger" role="alert" style={{ marginRight:15 }}>
					  		Aún no has agregado ninguna sinodalía
							</div>
			  		</div>
					}
				</div>
			)
	}
}

export default SinodaliasTable