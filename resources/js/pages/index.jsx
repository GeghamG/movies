import { Button, Card, Spin } from "antd";
import { LoadingOutlined } from '@ant-design/icons';

import React, { useEffect, useState } from "react";
import axios from "axios";
import './movie.css';

const antIcon = <LoadingOutlined style={{ fontSize: 24, color: '#afafaf' }} spin />;

const Home = () => {
  const [movies, setMovies] = useState([])
  const [loading, setLoading] = useState(false)

  const getMovies = () => {
    setLoading(true)
    axios.get('/api/movies')
      .then(({data}) => {
        setMovies(data)
      })
      .finally(() => {
        setLoading(false)
      })
  }
  const fetchMovies = (buttonKey) => {
    setLoading(true)
    axios.post('/api/fetch-movies', {
      button_key: buttonKey
    })
      .then(({data}) => {
        if (data.success) {
          getMovies()
        }
      })
      .finally(() => {
        setLoading(false)
      })
  }

  useEffect(() => {
    getMovies()
  }, [])

  const renderButton = () => {
    return (
      <>
        <Button type="primary" className="mr-2" onClick={() => fetchMovies('first')} size="large">
          {loading && <Spin indicator={antIcon} />}
          Fetch Data 1
        </Button>
        <Button type="primary" className="mr-2" onClick={() => fetchMovies('second')} size="large">Fetch Data 2</Button>
        <Button type="primary" className="mr-2" onClick={() => fetchMovies('thirst')} size="large">Fetch Data 3</Button>
      </>
    )
  }

  const renderMovies = () => {
    return (
      <>
      {
        movies.map(movie => {
          return  <Card
              hoverable
              key={movie.id}
              style={{ width: 240, height: 400, marginBottom: '25px' }}
              cover={<img alt={movie.title} src={movie.poster?.url} />}
            >
              <Card.Meta title={movie.title + ', ' + movie.year}/>
            </Card>
        })
      }
      </>
    )
  }
  return <div>
    <div>{renderButton()}</div>
    <div className="movies">{renderMovies()}</div>
  </div>;
};

export default Home;
