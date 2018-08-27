import React, { Component } from 'react'
import axios from 'axios'

class CreateNewAssigment extends Component {
	constructor (props) {
		super(props)
		this.state = {
			residente: '',
			carrera: 'electrica',
			num_control: 0,
			proyecto: '',
			presidente: 0,
			secretario: 0,
			vocal: 0,
			vocalSuplente: 0,
			teachers: [],
			periodosAct: [],
			periodoSeleccionado: 0,
		}
		//bindings
		this.handleSubmit = this.handleSubmit.bind(this)
		// this.postSinodaliaData = this.postSinodaliaData.bind(this)
		// this.getTeachersData = this.getTeachersData.bind(this)

		this.handleChangeResidente = this.handleChangeResidente.bind(this)
		this.handleChangeCarrera = this.handleChangeCarrera.bind(this)
		this.handleChangeControl = this.handleChangeControl.bind(this)
		this.handleChangeProyecto = this.handleChangeProyecto.bind(this)
		this.handleChangePeriodo = this.handleChangePeriodo.bind(this)
		this.handleChangePresidente = this.handleChangePresidente.bind(this)
		this.handleChangeSecretario = this.handleChangeSecretario.bind(this)
		this.handleChangeVocal = this.handleChangeVocal.bind(this)
		this.handleChangeVocalSuplente = this.handleChangeVocalSuplente.bind(this)
	}

	postSinodaliaData() {
		axios.post('/newsinodalia', {
			residente: this.state.residente,
			carrera: this.state.carrera,
			num_control: this.state.num_control,
			proyecto: this.state.proyecto,
			periodo: this.state.periodoSeleccionado,
			presidente: this.state.presidente,
			secretario: this.state.secretario,
			vocal: this.state.vocal,
			vocalSuplente: this.state.vocalSuplente,
		}).then(
			response => {
				var text = "La sinodalía se creó con éxito."
				alert(text)
				console.log(response)
			}
		)
		// limpiar los campos a los estandar
		this.setState({
					residente: '',
					carrera: 'electrica',
					num_control: 0,
					proyecto: '',
					presidente: 0,
					secretario: 0,
					vocal: 0,
					vocalSuplente: 0,
					teachers: [],
					periodosAct: [],
					periodoSeleccionado: 0,
		})
	}

	handleSubmit(event) {
		event.preventDefault()
		// posted to the backend
		this.postSinodaliaData()
		// this.seState({

		// })
		console.log(this.state)
		this.getTeachersData()
		this.getPeriodosAbiertos()
	}

	getTeachersData() {
		axios.get('/teachers')
		.then((response) => {
					let availableTeachers = response.data.teachers
					/* 

					logica para el FILTRO INTELIGENTE
								AQUI

					*/ 
					console.log("done")
					// para que no sea 0 el id en stados
					this.setState({
						teachers: [...availableTeachers],
						presidente: availableTeachers[0].id,
						secretario: availableTeachers[0].id,
						vocal: availableTeachers[0].id,
						vocalSuplente: availableTeachers[0].id
					})
				}
			)
		}

	getPeriodosAbiertos() {
		axios.get('/periodosDisponibles')
		.then((response) => {
			this.setState({
				periodosAct: [...response.data.periodosActivos],
				periodoSeleccionado: response.data.periodosActivos[0].id,
			})
		})
	}

	componentWillMount () {
		// loading teachers lists
		this.getTeachersData()
		this.getPeriodosAbiertos()
	}

	handleChangeResidente(event) {
		this.setState({
			residente: event.target.value,
		})
	}
	handleChangeCarrera(event) {
		this.setState({
			carrera: event.target.value,
		})
	}
	handleChangeControl(event) {
		this.setState({
			num_control: event.target.value,
		})
	}
	handleChangeProyecto(event) {
		this.setState({
			proyecto: event.target.value,
		})
	}
	handleChangePeriodo(event) {
		this.setState({
			periodoSeleccionado: event.target.value,
		})
	}
	handleChangePresidente(event) {
		this.setState({
			presidente: event.target.value,
		})
	}
	handleChangeSecretario(event) {
		this.setState({
			secretario: event.target.value,
		})
	}
	handleChangeVocal(event) {
		this.setState({
			vocal: event.target.value,
		})
	}
	handleChangeVocalSuplente(event) {
		this.setState({
			vocalSuplente: event.target.value,
		})
	}
	render(){
		return(
				<div className="card">
					<div className="card-header">
						<h2>Asignación de nueva Sinodalía</h2>
					</div>
					<div className="card-body">
						<form onSubmit={this.handleSubmit}>
						<div className="form-group">
							<label htmlFor="residente">Nombre del residente</label>
							<input id="residente" type="text" className="form-control"
								onChange={this.handleChangeResidente} value={this.state.residente}
								required/>
						</div>
						<div className="form-group">
							<label htmlFor="carrera">Carrera</label>
							<select className="form-control" id="carrera"
											onChange={this.handleChangeCarrera} value={this.state.carrera}>
								<option value="electrica">Ingeniería Eléctrica</option>
								<option value="mecatronica">Ingeniería Mecatrónica</option>
								<option value="electromecanica">Ingeniería Electromecánica</option>
							</select>	
						</div>
						<div className="form-group">
							<label htmlFor="num_control">Num. de Control</label>
							<input id="num_control" type="number" className="form-control" 
											onChange={this.handleChangeControl} value={this.state.num_control}
							required/>
						</div>
						<div className="form-group">
							<label htmlFor="proyecto">Nombre del Proyecto</label>
							<input id="proyecto" type="text" className="form-control" 
								onChange={this.handleChangeProyecto} value={this.state.proyecto}
							required/>
						</div>
						<div className="form-group">
							<label htmlFor="periodo1">Periodo disponible(Activo)</label>
							<select className="form-control" id="periodo1" 
											onChange={this.handleChangePeriodo} value={this.state.periodoSeleccionado}>
								{ this.state.periodosAct.map( periodo => (
										<option key={ periodo.id } value={ periodo.id }>{ periodo.name }</option>
									)) }
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="presidente">Asignado Presidente(disponibles)</label>
							<select className="form-control" id="presidente" 
											onChange={this.handleChangePresidente} value={this.state.presidente}>
								{ this.state.teachers.map( teacher => (
										<option key={ teacher.id } value={ teacher.id }>{ teacher.name }</option>
									)) }
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="secretario">Asignado Secretario(disponibles)</label>
							<select className="form-control" id="secretario"
											onChange={this.handleChangeSecretario} value={this.state.secretario}>
								{ this.state.teachers.map( teacher => (
										<option key={ teacher.id } value={ teacher.id }>{ teacher.name }</option>
									)) }
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="vocal">Asignado Vocal(disponibles)</label>
							<select className="form-control" id="vocal" 
												onChange={this.handleChangeVocal} value={this.state.vocal}>>
								{ this.state.teachers.map( teacher => (
										<option key={ teacher.id } value={ teacher.id }>{ teacher.name }</option>
									)) }
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="vocalSuplente">Asignado Vocal Suplente(disponibles)</label>
							<select className="form-control" id="vocalSuplente"
												onChange={this.handleChangeVocalSuplente} value={this.state.vocalSuplente}>>
								{ this.state.teachers.map( teacher => (
										<option key={ teacher.id } value={ teacher.id }>{ teacher.name }</option>
									)) }
							</select>
						</div>
						<input type="submit" value="Crear sinodalía" className="btn btn-success form-control" />
					</form>
					</div>
				</div>
			)
	}
}

export default CreateNewAssigment