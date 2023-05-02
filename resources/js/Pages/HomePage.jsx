import React from 'react';
import { Link, Head } from '@inertiajs/react';

function HomePage(props) {
  return (
    <>
      <Head title={props.title} />
      <div>HomePage</div>
    </>
  )
}

export default HomePage;