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

	render() {
		return (
			<div className="container">
				<div >
					<h2>Detalles de maestros</h2>
				</div>
				<div className="row">
				
					{ this.state.teachers.map((teacher) => (
						<div class="alert alert-success" role="alert" style={{ marginRight:15 }}>
						  {teacher.name} | {teacher.num_asignaciones}
						</div>
						)) }
				</div>
			</div>
			)
	}
}

export default AllTeachersListing