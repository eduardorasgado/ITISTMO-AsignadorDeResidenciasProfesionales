import React, { Component } from 'react'

class AllTeachersListing extends Component {
	constructor(props) {
		super(props)
		this.state = {
			teachers: [],
		}
	}

	componentWillMount () {
		this.getTeachersData()
	}
	componentDidMount() {
		// actualizar cada 10 segundos
		this.interval = setInterval(() => this.getTeachersData(), 10000)
	}

	componentWillUnmount() {
		// limpiar el montaje
			clearInterval(this.interval)
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

	disponible(disp){
		if (disp) {
			return "L"
		}
		return "D"
	}

	render() {
		return (
			<div className="container">
				<div >
					<h2>Detalles de maestros</h2>
				</div>
				<div className="row">
				
					{ this.state.teachers.map((teacher) => (
						<div key={teacher.id} className="alert alert-success" role="alert" style={{ marginRight:15 }}>
						  {teacher.name} | {teacher.num_asignaciones} | { this.disponible(teacher.disponibilidad) }
						</div>
						)) }
				</div>
				<p>L = Lleno; D = Disponible</p>
			</div>
			)
	}
}

export default AllTeachersListing