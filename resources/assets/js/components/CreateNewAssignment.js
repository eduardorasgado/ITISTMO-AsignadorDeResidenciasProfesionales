import React, { Component } from 'react'
import axios from 'axios'

class CreateNewAssigment extends Component {
	constructor (props) {
		super(props)
		this.state = {
			residente: '',
			carrera: '',
			num_control: 0,
			proyecto: '',
			presidente: 0,
			secretario: 0,
			vocal: 0,
			vocalSuplente: 0,
			teachers: [],
		}
		//bindings
		this.handleSubmit = this.handleSubmit.bind(this)
		this.handleChangeResidente = this.handleChangeResidente.bind(this)
		this.handleChangeCarrera = this.handleChangeCarrera.bind(this)
		this.handleChangeControl = this.handleChangeControl.bind(this)
		this.handleChangeProyecto = this.handleChangeProyecto.bind(this)
		this.handleChangePresidente = this.handleChangePresidente.bind(this)
		this.handleChangeSecretario = this.handleChangeSecretario.bind(this)
		this.handleChangeVocal = this.handleChangeVocal.bind(this)
		this.handleChangeVocalSuplente = this.handleChangeVocalSuplente.bind(this)
	}

	postTeachersData() {
		axios.post('/teachers')
	}

	handleSubmit(event) {
		event.preventDefault()
		// this.seState({

		// })
		console.log("data here!!")
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
											onChange={this.handleChangeCarrera} value={this.state.carrera}
											required>
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
							<label htmlFor="presidente">Asignado Presidente(disponibles)</label>
							<select className="form-control" id="presidente" 
											onChange={this.handleChangePresidente} value={this.state.presidente}>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="secretario">Asignado Secretario(disponibles)</label>
							<select className="form-control" id="secretario"
											onChange={this.handleChangeSecretario} value={this.state.secretario}>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="vocal">Asignado Vocal(disponibles)</label>
							<select className="form-control" id="vocal" 
												onChange={this.handleChangeVocal} value={this.state.vocal}>>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label htmlFor="vocalSuplente">Asignado Vocal Suplente(disponibles)</label>
							<select className="form-control" id="vocalSuplente"
												onChange={this.handleChangeVocalSuplente} value={this.state.vocalSuplente}>>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<input type="submit" value="Crear sinodalía" className="form-control" />
					</form>
					</div>
				</div>
			)
	}
}

export default CreateNewAssigment