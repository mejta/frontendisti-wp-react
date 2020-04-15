/*
You have to setup Webpack Public Path, so the application knows how to
dinamically load the chunks. Without that, dynamic imports won't work.
It must me set before any import.
*/
__webpack_public_path__ = window.WPReact.publicPath;

import React, { lazy, Suspense } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { __ } from '@wordpress/i18n';

import store from './store/root';

// ExampleSubapp will be loaded in separate chunk
const ExampleSubapp = lazy(() => import('./components/ExamplePortalApp'));

const App = () => {
  return (
    <Provider store={store}>
      <h1>
        {__('This is the root of the application', 'wpreact')}
      </h1>
      <Suspense fallback={<div />}>
        <ExampleSubapp />
      </Suspense>
    </Provider>
  );
};

ReactDOM.render(<App />, document.querySelector('#wpreact'));
